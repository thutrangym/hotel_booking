<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        /** ======================
         * 1. CURRENT IN ROOMS
         * ====================== */
        $currentInRooms = Booking::where('status', 'confirmed')
            ->where('check_in', '<=', $today)
            ->where('check_out', '>', $today)
            ->get();

        $currentRoomsCount = $currentInRooms->count();
        $currentPax = $currentInRooms->sum('quantity');

        /** ======================
         * 2. EXPECTED ARRIVALS
         * ====================== */
        $expectedArrivals = Booking::whereDate('check_in', $today)
            ->whereNotIn('status', ['cancelled'])
            ->get();

        $arrivalRooms = $expectedArrivals->count();
        $arrivalPax = $expectedArrivals->sum('quantity');

        /** ======================
         * 3. EXPECTED DEPARTURES
         * ====================== */
        $expectedDepartures = Booking::whereDate('check_out', $today)
            ->where('status', 'confirmed')
            ->get();

        $departureRooms = $expectedDepartures->count();
        $departurePax = $expectedDepartures->sum('quantity');

        /** ======================
         * 4. END OF DAY FORECAST
         * ====================== */
        $endDayRooms = $currentRoomsCount + $arrivalRooms - $departureRooms;
        $endDayPax = $currentPax + $arrivalPax - $departurePax;

        /** ======================
         * 5. ROOM STATUS PIE
         * ====================== */
        $totalRooms = Room::count();

        $roomsReady = Room::where('status', 'available')->count();
        $roomsExpected = Booking::whereDate('check_in', $today)->count();
        $roomsCheckedInToday = Booking::whereDate('created_at', $today)
            ->where('status', 'confirmed')
            ->count();

        /** ======================
         * 6. REVENUE (DAILY)
         * ====================== */
        $dailyRevenue = Booking::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
            ->where('payment_status', 'paid')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'currentRoomsCount',
            'currentPax',
            'arrivalRooms',
            'arrivalPax',
            'departureRooms',
            'departurePax',
            'endDayRooms',
            'endDayPax',
            'roomsReady',
            'roomsExpected',
            'roomsCheckedInToday',
            'totalRooms',
            'dailyRevenue'
        ));
    }

    /**
     * Return JSON stats for charts based on range: day|week|month
     */
    public function stats(Request $request)
    {
        $range = $request->get('range', 'week');
        $now = Carbon::now();

        if ($range === 'day') {
            $start = Carbon::today();
            $end = $start->copy()->endOfDay();

            // Revenue grouped by hour
            $revenues = Booking::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('SUM(total_price) as total')
            )
                ->where('payment_status', 'paid')
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();

            $labels = [];
            $data = [];

            for ($h = 0; $h < 24; $h++) {
                $labels[] = sprintf('%02d:00', $h);
                $found = $revenues->firstWhere('hour', $h);
                $data[] = $found ? (float) $found->total : 0;
            }

            $periodStart = $start->copy();
            $periodEnd = $end->copy();
        } else {
            $days = $range === 'month' ? 30 : 7;
            $periodStart = Carbon::today()->subDays($days - 1)->startOfDay();
            $periodEnd = Carbon::today()->endOfDay();

            // Revenue grouped by date
            $revenues = Booking::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
                ->where('payment_status', 'paid')
                ->whereBetween('created_at', [$periodStart, $periodEnd])
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->keyBy('date');

            $labels = [];
            $data = [];

            $current = $periodStart->copy();
            while ($current->lte(Carbon::today())) {
                $label = $current->format('Y-m-d');
                $labels[] = $label;
                $data[] = isset($revenues[$label]) ? (float) $revenues[$label]->total : 0;
                $current->addDay();
            }
        }

        // Room status snapshot for the period
        $roomsReady = Room::where('status', 'available')->count();
        $roomsExpected = Booking::whereBetween('check_in', [$periodStart, $periodEnd])
            ->whereNotIn('status', ['cancelled'])
            ->count();
        $roomsCheckedIn = Booking::whereBetween('check_in', [$periodStart, $periodEnd])
            ->where('status', 'confirmed')
            ->count();

        return response()->json([
            'roomStatus' => [
                'ready' => $roomsReady,
                'expected' => $roomsExpected,
                'checkedIn' => $roomsCheckedIn,
            ],
            'revenue' => [
                'labels' => $labels,
                'data'   => $data,
            ],
            'range' => $range,
        ]);
    }
}
