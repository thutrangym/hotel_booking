@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">My Booking History</h2>
        <hr class="w-25 mx-auto">
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
    <div class="text-center text-muted py-5">
        <i class="bi bi-calendar-x fs-1"></i>
        <p class="mt-3">You have no bookings yet.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $booking->room->name }}</strong>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>

                    <td>{{ $booking->quantity }}</td>

                    <td>
                        <span class="fw-bold text-success">
                            {{ number_format($booking->total_price) }} VND
                        </span>
                    </td>

                    {{-- Booking status --}}
                    <td>
                        @php
                        $statusColor = match($booking->status) {
                        'pending' => 'warning',
                        'confirmed' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'secondary',
                        default => 'dark'
                        };
                        @endphp

                        <span class="badge bg-{{ $statusColor }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>

                    {{-- Payment status --}}
                    <td>
                        @php
                        $paymentColor = match($booking->payment_status) {
                        'paid' => 'success',
                        'failed' => 'danger',
                        'unpaid' => 'secondary',
                        default => 'dark'
                        };
                        @endphp

                        <span class="badge bg-{{ $paymentColor }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td>
                        {{-- View --}}
                        <a href="{{ route('booking.show', $booking) }}"
                            class="btn btn-sm btn-outline-dark mb-1">
                            View
                        </a>

                        {{-- Retry payment --}}
                        @if($booking->payment_status === 'failed' && $booking->status === 'pending')
                        <form method="POST"
                            action="{{ route('payment.retry', $booking) }}"
                            class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-arrow-repeat"></i> Retry
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection