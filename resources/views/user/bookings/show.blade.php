@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="mb-4">
        <a href="{{ route('booking.history') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to history
        </a>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-light rounded-top-4">
            <h4 class="mb-0 fw-bold">Booking Details</h4>
        </div>

        <div class="card-body p-4">

            {{-- FLASH --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row g-4">

                {{-- ROOM INFO --}}
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Room Information</h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Room:</strong> {{ $booking->room->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Price / night:</strong>
                            {{ number_format($booking->room->price) }} VND
                        </li>
                        <li class="list-group-item">
                            <strong>Guests:</strong> {{ $booking->quantity }}
                        </li>
                    </ul>
                </div>

                {{-- BOOKING INFO --}}
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Booking Information</h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Guest name:</strong> {{ $booking->guest_name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Phone:</strong> {{ $booking->phone }}
                        </li>
                        <li class="list-group-item">
                            <strong>Check-in:</strong>
                            {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Check-out:</strong>
                            {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}
                        </li>

                        @if($booking->actual_check_out_date)
                        <li class="list-group-item">
                            <strong>Actual check-out:</strong>
                            {{ \Carbon\Carbon::parse($booking->actual_check_out_date)->format('d/m/Y') }}
                        </li>
                        @endif

                        @if($booking->note)
                        <li class="list-group-item">
                            <strong>Note:</strong> {{ $booking->note }}
                        </li>
                        @endif
                    </ul>
                </div>

                {{-- STATUS --}}
                <div class="col-12">
                    <hr>
                    <h5 class="fw-bold mb-3">Status</h5>

                    @php
                    $bookingColor = match($booking->status) {
                    'pending' => 'warning',
                    'confirmed' => 'primary',
                    'completed' => 'success',
                    'cancelled' => 'secondary',
                    default => 'dark'
                    };

                    $paymentColor = match($booking->payment_status) {
                    'paid' => 'success',
                    'failed' => 'danger',
                    'unpaid' => 'secondary',
                    default => 'dark'
                    };
                    @endphp

                    <p class="mb-2">
                        <strong>Booking status:</strong>
                        <span class="badge bg-{{ $bookingColor }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Payment status:</strong>
                        <span class="badge bg-{{ $paymentColor }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </p>

                    <p class="mb-0">
                        <strong>Total price:</strong>
                        <span class="fw-bold text-success">
                            {{ number_format($booking->total_price) }} VND
                        </span>
                    </p>
                </div>

                {{-- ACTION --}}
                <div class="col-12 mt-4">
                    <div class="d-flex gap-2">

                        {{-- Retry payment --}}
                        @if($booking->payment_status === 'failed' && $booking->status === 'pending')
                        <form method="POST" action="{{ route('payment.retry', $booking) }}">
                            @csrf
                            <button class="btn btn-warning">
                                <i class="bi bi-arrow-repeat"></i> Retry Payment
                            </button>
                        </form>
                        @endif

                        {{-- Paid --}}
                        @if($booking->payment_status === 'paid')
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <i class="bi bi-check-circle"></i> Payment Completed
                        </span>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection