@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow border-0 rounded-4">
                <div class="card-body text-center p-5">

                    {{-- ICON --}}
                    @if($booking->payment_status === 'paid')
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="fw-bold text-success mb-3">Payment Successful</h3>
                    <p class="text-muted mb-4">
                        Your booking has been confirmed successfully.
                    </p>
                    @else
                    <div class="mb-4">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="fw-bold text-danger mb-3">Payment Failed</h3>
                    <p class="text-muted mb-4">
                        Something went wrong. Please try again.
                    </p>
                    @if($booking->payment_status === 'failed')
                    <form method="POST" action="{{ route('payment.retry', $booking) }}">
                        @csrf
                        <button class="btn btn-warning px-4">
                            <i class="bi bi-arrow-repeat me-1"></i> Retry Payment
                        </button>
                    </form>
                    @endif

                    @endif

                    {{-- BOOKING INFO --}}
                    <div class="text-start border rounded-3 p-4 mb-4 bg-light">
                        <p class="mb-2"><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                        <p class="mb-2"><strong>Guest Name:</strong> {{ $booking->guest_name }}</p>
                        <p class="mb-2"><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</p>
                        <p class="mb-2"><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</p>
                        <p class="mb-2"><strong>Total Price:</strong>
                            <span class="fw-bold text-dark">
                                {{ number_format($booking->total_price) }} VND
                            </span>
                        </p>
                        <p class="mb-0">
                            <strong>Status:</strong>
                            @if($booking->status === 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                            @elseif($booking->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($booking->status === 'completed')
                            <span class="badge bg-primary">Completed</span>
                            @else
                            <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('booking.history') }}" class="btn btn-outline-dark px-4">
                            <i class="bi bi-clock-history me-1"></i> My Bookings
                        </a>

                        <a href="{{ route('home') }}" class="btn btn-dark px-4">
                            <i class="bi bi-house-door me-1"></i> Back Home
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection