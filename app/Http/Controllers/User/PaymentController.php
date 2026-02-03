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
        // Giả lập kết quả thanh toán
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
}
