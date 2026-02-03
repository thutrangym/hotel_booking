<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function retry(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.history')
                ->with('error', 'This booking is already paid.');
        }

        // ===== MOCK PAYMENT =====

        $isSuccess = rand(0, 1); // random success / fail

        if ($isSuccess) {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
            ]);

            return redirect()->route('payment.result', $booking)
                ->with('success', 'Payment successful!');
        } else {
            $booking->update([
                'payment_status' => 'failed',
            ]);

            return redirect()->route('payment.result', $booking)
                ->with('error', 'Payment failed. Please try again.');
        }
    }

    // Show payment page (mock)
    public function pay(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.payment.pay', compact('booking'));
    }

    // Process payment form (mock)
    public function process(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.history')
                ->with('error', 'This booking is already paid.');
        }

        // ===== MOCK PAYMENT =====
        $isSuccess = rand(0, 1);

        if ($isSuccess) {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
            ]);

            return redirect()->route('payment.result', $booking)
                ->with('success', 'Payment successful!');
        } else {
            $booking->update([
                'payment_status' => 'failed',
            ]);

            return redirect()->route('payment.result', $booking)
                ->with('error', 'Payment failed. Please try again.');
        }
    }

    // Show payment result
    public function result(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.payment.result', compact('booking'));
    }

    // Mock return from external gateway
    public function return(Request $request)
    {
        return redirect()->route('home')->with('success', 'Returned from payment gateway (mock).');
    }
}
