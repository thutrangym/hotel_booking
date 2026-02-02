<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /* ===============================
        LIST
    =============================== */
    public function index()
    {
        $bookings = Booking::with(['room', 'user'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /* ===============================
        SHOW DETAIL
    =============================== */
    public function show(Booking $booking)
    {
        $booking->load([
            'user',
            'room.facilities',
            'room.images',
        ]);

        return view('admin.bookings.show', compact('booking'));
    }

    /* ===============================
        EDIT
    =============================== */
    public function edit(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.edit', compact('booking'));
    }

    /* ===============================
        STORE (ADMIN CREATE)
    =============================== */
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

            Booking::create([
                'user_id'     => auth()->id(),
                'room_id'     => $room->id,
                'quantity'    => $data['quantity'],
                'check_in'    => $data['check_in'],
                'check_out'   => $data['check_out'],
                'total_price' => $room->price * $data['quantity'],
                'status'      => 'confirmed',
                'payment_status' => 'unpaid',
            ]);
        });

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully');
    }

    /* ===============================
        UPDATE (SMART LOGIC)
    =============================== */
    public function update(Request $request, Booking $booking)
    {
        if ($request->has('status')) {
            $booking->update([
                'status' => $request->status,
            ]);

            return back()->with('success', 'Booking status updated successfully.');
        }
        $data = $request->validate([
            'check_in'               => 'required|date',
            'check_out'              => 'required|date|after:check_in',
            'actual_check_out_date'  => 'nullable|date',
            'status'                 => 'required|in:pending,confirmed,checked_in,checked_out,cancelled,completed',
            'payment_status'         => 'required|in:unpaid,paid,refunded',
            'refund_amount'          => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($booking, $data) {

            $room = Room::lockForUpdate()->find($booking->room_id);

            $oldStatus = $booking->status;
            $newStatus = $data['status'];



            /* ===============================
                1. CHECK-IN → TRỪ PHÒNG
            =============================== */
            if ($oldStatus !== 'checked_in' && $newStatus === 'checked_in') {

                if ($room->available_rooms < $booking->quantity) {
                    abort(400, 'Not enough available rooms');
                }

                $room->decrement('available_rooms', $booking->quantity);
            }

            /* ===============================
                2. CHECKED-IN → CHECKED-OUT (NORMAL / EARLY)
            =============================== */
            if (
                $oldStatus === 'checked_in'
                && in_array($newStatus, ['checked_out', 'cancelled'])
            ) {
                $room->increment('available_rooms', $booking->quantity);
            }

            /* ===============================
                3. EARLY CHECK-OUT
            =============================== */
            if (!empty($data['actual_check_out_date'])) {
                $data['status'] = 'checked_out';

                if ($data['refund_amount'] > 0) {
                    $data['payment_status'] = 'refunded';
                }
            }

            /* ===============================
                4. CANCELLED (BEFORE CHECK-IN)
            =============================== */
            if ($oldStatus !== 'cancelled' && $newStatus === 'cancelled') {

                if ($data['refund_amount'] > 0) {
                    $data['payment_status'] = 'refunded';
                }
            }

            /* ===============================
                5. UPDATE BOOKING
            =============================== */
            $booking->update([
                'check_in'              => $data['check_in'],
                'check_out'             => $data['check_out'],
                'actual_check_out_date' => $data['actual_check_out_date'],
                'status'                => $data['status'],
                'payment_status'        => $data['payment_status'],
                'refund_amount'         => $data['refund_amount'],
            ]);
        });

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Booking updated successfully');
    }

    /* ===============================
        DELETE
    =============================== */
    public function destroy(Booking $booking)
    {
        DB::transaction(function () use ($booking) {

            if ($booking->status === 'checked_in') {
                $booking->room->increment('available_rooms', $booking->quantity);
            }

            $booking->delete();
        });

        return back()->with('success', 'Booking deleted');
    }
}
