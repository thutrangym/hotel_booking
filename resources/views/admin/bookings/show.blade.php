@extends('layouts.app')

@section('content')
<div class="container py-4">

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary mb-3">
        ← Back to bookings
    </a>
    <h4 class="mb-4">
        Booking Detail
    </h4>
    <div class="row g-4">

        {{-- BOOKING INFO --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Booking Information</strong>

                    {{-- Edit button --}}
                    <a href="{{ route('admin.bookings.edit', $booking) }}"
                        class="btn btn-sm btn-primary">
                        Edit
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Booking ID</th>
                            <td>#{{ $booking->id }}</td>
                        </tr>

                        <tr>
                            <th>Check-in Date</th>
                            <td>{{ $booking->check_in }}</td>
                        </tr>

                        <tr>
                            <th>Check-out Date</th>
                            <td>{{ $booking->check_out }}</td>
                        </tr>

                        <tr>
                            <th>Actual Check-out</th>
                            <td>
                                {{ $booking->actual_check_out_date ?? '—' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-info text-uppercase">
                                    {{ $booking->status }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Payment Status</th>
                            <td>
                                <span class="badge bg-success text-uppercase">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Total Price</th>
                            <td>{{ number_format($booking->total_price) }} ₫</td>
                        </tr>

                        <tr>
                            <th>Refund Amount</th>
                            <td>
                                {{ number_format($booking->refund_amount) }} ₫
                            </td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $booking->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- USER INFO --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Customer Information</strong>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Name</th>
                            <td>{{ $booking->user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->user->email }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $booking->user->phone ?? '—' }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td class="text-uppercase">
                                {{ $booking->user->role }}
                            </td>
                        </tr>

                        <tr>
                            <th>Registered At</th>
                            <td>{{ $booking->user->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- ROOM INFO --}}
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Room Information</div>
                <div class="card-body">

                    <h5>{{ $booking->room->name }}</h5>
                    <p><strong>Price:</strong> ${{ $booking->room->price }} / night</p>
                    <p><strong>Capacity:</strong> {{ $booking->room->capacity }} persons</p>

                    {{-- Facilities --}}
                    <div class="mb-3">
                        <strong>Facilities:</strong>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            @foreach($booking->room->facilities as $facility)
                            <div class="d-flex align-items-center gap-1">
                                @if($facility->icon)
                                <img src="{{ asset('icons/'.$facility->icon) }}" width="18">
                                @endif
                                <span>{{ $facility->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="row">
                        @foreach($booking->room->images as $img)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset('storage/'.$img->image_path) }}"
                                class="img-fluid rounded shadow-sm">
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection