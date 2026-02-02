@extends('layouts.app')

@section('content')
<div class="container py-4">

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary mb-3">
        ← Back to bookings
    </a>

    <div class="row g-4">

        {{-- BOOKING INFO --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Booking Information</div>
                <div class="card-body">
                    <p><strong>ID:</strong> #{{ $booking->id }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-{{ 
                            $booking->status === 'confirmed' ? 'success' : 
                            ($booking->status === 'cancelled' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </p>
                    <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
                    <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
                    <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
                    <p><strong>Total price:</strong> ${{ $booking->total_price }}</p>
                </div>
            </div>
        </div>

        {{-- USER INFO --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Customer</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
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