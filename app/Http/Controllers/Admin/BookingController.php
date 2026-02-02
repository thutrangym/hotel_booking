<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // LIST BOOKING
    public function index()
    {
        $bookings = Booking::with(['room', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    // SHOW BOOKING DETAIL
    public function show(Booking $booking)
    {
        $booking->load([
            'user',
            'room.facilities',
            'room.images'
        ]);

        return view('admin.bookings.show', compact('booking'));
    }


    // CREATE BOOKING (ADMIN)
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'quantity'  => 'required|integer|min:1',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        DB::transaction(function () use ($data) {

            $room = Room::lockForUpdate()->findOrFail($data['room_id']);

            if ($room->available_rooms < $data['quantity']) {
                abort(400, 'Not enough available rooms');
            }

            Booking::create([
                'user_id'      => auth()->user()->id,
                'room_id'      => $room->id,
                'quantity'     => $data['quantity'],
                'check_in'     => $data['check_in'],
                'check_out'    => $data['check_out'],
                'total_price'  => $room->price * $data['quantity'],
                'status'       => 'confirmed',
            ]);

            $room->decrement('available_rooms', $data['quantity']);
        });

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully');
    }

    // UPDATE STATUS BOOKING
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        DB::transaction(function () use ($request, $booking) {

            $oldStatus = $booking->status;
            $newStatus = $request->status;

            $room = $booking->room;
            $quantity = $booking->quantity;

            if ($oldStatus === $newStatus) {
                return;
            }

            /**
             *  PENDING / CANCELLED → CONFIRMED
             */
            if ($newStatus === 'confirmed') {
                if ($room->available_rooms < $quantity) {
                    abort(400, 'Not enough available rooms');
                }

                $room->decrement('available_rooms', $quantity);
            }

            /**
             * 🔺 CONFIRMED → CANCELLED
             */
            if ($oldStatus === 'confirmed' && $newStatus === 'cancelled') {
                $room->increment('available_rooms', $quantity);
            }
            /**
             * 🔺 CONFIRMED → COMPLETED
             */
            if ($oldStatus === 'confirmed' && $newStatus === 'completed') {
                $room->increment('available_rooms', $quantity);
            }

            // Update booking status
            $booking->update([
                'status' => $newStatus,
            ]);
        });

        return back()->with('success', 'Booking status updated');
    }

    // DELETE BOOKING
    public function destroy(Booking $booking)
    {
        DB::transaction(function () use ($booking) {

            if ($booking->status !== 'cancelled') {
                $booking->room->increment('available_rooms', $booking->quantity);
            }

            $booking->delete();
        });

        return back()->with('success', 'Booking deleted');
    }
}
