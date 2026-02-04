<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        return view('user.bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'quantity'  => 'required|integer|min:1',
            'guest_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($request->room_id);

        $days = now()->parse($request->check_in)
            ->diffInDays(now()->parse($request->check_out));

        $totalPrice = $room->price * $days * $request->quantity;

        $booking = Booking::create([
            'room_id'        => $room->id,
            'user_id'        => Auth::id(),
            'quantity'       => $request->quantity,
            'guest_name'     => $request->guest_name,
            'phone'          => $request->phone,
            'note'           => $request->note,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'total_price'    => $totalPrice,
        ]);

        return redirect()
            ->route('payment.pay', $booking->id)
            ->with('success', 'Booking created successfully!');
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.bookings.history', compact('bookings'));
    }
}
