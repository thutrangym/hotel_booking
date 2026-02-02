<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ===== BOOKINGS =====
        $currentInHouse = Booking::where('status', 'checked_in')->count();

        $expectedArrivals = Booking::whereDate('check_in', $today)
            ->where('status', 'pending')
            ->count();

        $expectedDepartures = Booking::whereDate('check_out', $today)
            ->whereIn('status', ['checked_in', 'confirmed'])
            ->count();

        $endOfDay = $currentInHouse + $expectedArrivals - $expectedDepartures;

        // ===== PAX =====
        $paxInHouse = Booking::where('status', 'checked_in')->sum('quantity');

        $paxArrivals = Booking::whereDate('check_in', $today)->sum('quantity');
        $paxDepartures = Booking::whereDate('check_out', $today)->sum('quantity');

        $paxEndOfDay = $paxInHouse + $paxArrivals - $paxDepartures;

        // ===== ROOM STATUS =====
        $roomStatus = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', compact(
            'currentInHouse',
            'expectedArrivals',
            'expectedDepartures',
            'endOfDay',
            'paxInHouse',
            'paxArrivals',
            'paxDepartures',
            'paxEndOfDay',
            'roomStatus'
        ));
    }
}
