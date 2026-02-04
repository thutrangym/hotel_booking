<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Facility;


class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'rooms'      => Room::with('facilities')->where('status', 'available')->limit(3)->get(),
        ]);
    }

    public function live()
    {
        return view('pages.live');
    }

    public function rooms(Request $request)
    {
        $query = Room::query();


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pax = intval($request->get('adult', 1)) + intval($request->get('children', 0));
        if ($pax > 0) {
            $query->where('capacity', '>=', $pax);
        }

        // If dates are provided, compute availability by subtracting overlapping bookings
        if ($request->filled('check_in') && $request->filled('check_out')) {
            try {
                $checkIn = Carbon::parse($request->check_in);
                $checkOut = Carbon::parse($request->check_out);

                if ($checkOut->lte($checkIn)) {
                    return back()->withErrors(['check_out' => 'Check-out must be after check-in'])->withInput();
                }

                // Get sum of booked quantities per room for overlapping bookings
                $overlapping = Booking::where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                })->whereIn('status', ['pending', 'confirmed', 'checked_in'])
                    ->select('room_id', DB::raw('SUM(quantity) as booked'))
                    ->groupBy('room_id')
                    ->pluck('booked', 'room_id')
                    ->toArray();

                // Get candidate rooms and filter by remaining availability
                $candidates = $query->latest()->get()->filter(function ($room) use ($overlapping) {
                    $booked = intval($overlapping[$room->id] ?? 0);
                    $remaining = intval($room->total_rooms ?? 0) - $booked;
                    return $remaining > 0;
                });

                // Paginate the filtered collection
                $page = LengthAwarePaginator::resolveCurrentPage();
                $perPage = 9;
                $items = $candidates->forPage($page, $perPage)->values();
                $rooms = new LengthAwarePaginator($items, $candidates->count(), $perPage, $page, [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                ]);

                return view('pages.rooms', compact('rooms'));
            } catch (\Exception $e) {
                // If dates invalid, fall back to normal listing with an error message
                return back()->withErrors(['check_in' => 'Invalid dates provided'])->withInput();
            }
        }
        $rooms = $query->latest()->paginate(9);
        return view('pages.rooms', compact('rooms'));
    }

    public function facilities()
    {
        $facilities = Facility::all();

        return view('pages.facilities', compact('facilities'));
    }

    public function offers()
    {
        return view('pages.offers');
    }
    public function roomDetail(Room $room)
    {
        $room->load([
            'images',
            'facilities',
            'roomType'
        ]);

        return view('pages.room-detail', compact('room'));
    }
}
