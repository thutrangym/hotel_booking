@extends('layouts.app')


@section('content')
<div class="container">
    <h3 class="mb-4">Edit Booking #{{ $booking->id }}</h3>

    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PATCH')

        {{-- ================= BOOKING INFORMATION ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Booking Information</div>
            <div class="card-body row g-3">

                {{-- Check in --}}
                <div class="col-md-4">
                    <label class="form-label">Check-in Date</label>
                    <input type="date"
                        name="check_in"
                        class="form-control"
                        value="{{ $booking->check_in->format('Y-m-d') }}">
                </div>

                {{-- Check out --}}
                <div class="col-md-4">
                    <label class="form-label">Check-out Date</label>
                    <input type="date"
                        name="check_out"
                        class="form-control"
                        value="{{ $booking->check_out->format('Y-m-d') }}">
                </div>

                {{-- Actual check out (Early) --}}
                <div class="col-md-4">
                    <label class="form-label">
                        Actual Check-out (Early)
                    </label>
                    <input type="date"
                        name="actual_check_out_date"
                        class="form-control"
                        value="{{ optional($booking->actual_check_out_date)->format('Y-m-d') }}">
                </div>

                {{-- Status --}}
                <div class="col-md-4">
                    <label class="form-label">Booking Status</label>
                    <select name="status" class="form-select">
                        @foreach(['pending','confirmed','checked_in','checked_out','cancelled'] as $status)
                        <option value="{{ $status }}"
                            @selected($booking->status === $status)>
                            {{ ucfirst(str_replace('_',' ',$status)) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Payment status --}}
                <div class="col-md-4">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-select">
                        <option value="unpaid" @selected($booking->payment_status === 'unpaid')>Unpaid</option>
                        <option value="paid" @selected($booking->payment_status === 'paid')>Paid</option>
                        <option value="refunded" @selected($booking->payment_status === 'refunded')>Refunded</option>
                    </select>
                </div>

                {{-- Refund --}}
                <div class="col-md-4">
                    <label class="form-label">Refund Amount</label>
                    <input type="number"
                        name="refund_amount"
                        class="form-control"
                        min="0"
                        value="{{ $booking->refund_amount ?? 0 }}">
                </div>
            </div>
        </div>

        {{-- ================= CUSTOMER ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Customer</div>
            <div class="card-body">
                <p class="mb-1"><strong>Name:</strong> {{ $booking->user->name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $booking->user->email }}</p>
            </div>
        </div>

        {{-- ================= ROOM ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Room Information</div>
            <div class="card-body">
                <p class="mb-1"><strong>Room:</strong> {{ $booking->room->name }}</p>
                <p class="mb-1"><strong>Quantity:</strong> {{ $booking->quantity }}</p>
                <p class="mb-1"><strong>Price:</strong> ${{ $booking->total_price }}</p>
                <p class="mb-1">
                    <strong>Available Rooms:</strong>
                    {{ $booking->room->available_rooms }}
                </p>
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Save Changes
            </button>

            <a href="{{ route('admin.bookings.show', $booking) }}"
                class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection