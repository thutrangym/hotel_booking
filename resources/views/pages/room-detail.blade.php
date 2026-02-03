@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- ================= ROOM TITLE ================= --}}
    <div class="row mb-5 align-items-end">
        <div class="col-lg-8">
            <h1 class="fw-black text-dark mb-1 display-5">{{ $room->name }}</h1>
        </div>
        <div class="col-lg-4 text-lg-end">
            <div class="price-tag">
                <span class="h2 fw-black text-primary mb-0">{{ number_format($room->price) }} VND</span>
                <span class="text-muted small">/ night</span>
            </div>
        </div>
    </div>

    {{-- ================= ROOM IMAGES ================= --}}
    <div class="row g-3 mb-5">
        <div class="col-lg-8">
            <div class="img-wrapper main-img">
                <img src="{{ asset('storage/'.$room->images->first()->image_path) }}"
                    class="img-fluid rounded-4 shadow-sm"
                    style="width:100%; height:450px; object-fit:cover;">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row g-3">
                @foreach($room->images->slice(1,4) as $img)
                <div class="col-6">
                    <div class="img-wrapper sub-img">
                        <img src="{{ asset('storage/'.$img->image_path) }}"
                            class="img-fluid rounded-4 shadow-sm"
                            style="width:100%; height:217px; object-fit:cover;">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ================= ROOM INFO ================= --}}
    <div class="row g-5">
        <div class="col-lg-8">

            {{-- DESCRIPTION --}}
            <div class="info-section mb-5">
                <h4 class="fw-bold mb-4 pb-2 border-bottom border-2 border-primary d-inline-block">Description</h4>
                <p class="text-muted lh-lg fs-6">
                    {{ $room->description ?? 'Experience luxury and comfort in our meticulously designed rooms, featuring modern amenities and breathtaking views.' }}
                </p>
            </div>

            {{-- FACILITIES --}}
            <div class="info-section">
                <h4 class="fw-bold mb-4">Room Facilities</h4>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($room->facilities as $facility)
                    <span class="badge-facility shadow-sm">
                        @if($facility->icon)
                        <img src="{{ asset('icons/'.$facility->icon) }}" width="18" class="me-2">
                        @else
                        <i class="bi bi-check2-circle text-primary me-2"></i>
                        @endif
                        {{ $facility->name }}
                    </span>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ================= BOOKING CARD ================= --}}
        <div class="col-lg-4">
            <div class="card booking-card border-0 shadow-lg sticky-top rounded-4" style="top:100px">
                <div class="card-body p-4">
                    <h5 class="fw-black mb-4 text-center">Reservation</h5>

                    <div class="booking-details bg-light rounded-3 p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Room Price</span>
                            <span class="fw-bold">${{ number_format($room->price) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Status</span>
                            <span class="badge {{ $room->status === 'available' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill px-3">
                                {{ ucfirst($room->status) }}
                            </span>
                        </div>
                    </div>

                    @if($room->status !== 'available')
                    <button class="btn btn-secondary w-100 py-3 rounded-pill fw-bold" disabled>
                        Not Available
                    </button>
                    @else
                    @guest
                    <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm btn-hover-zoom custom-bg"
                        onclick="alert('Please login to book this room')">
                        Book Now
                    </button>
                    @endguest

                    @auth
                    <a href="{{ route('user.booking.create', $room->id) }}"
                        class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm btn-hover-zoom">
                        Book This Room
                    </a>
                    @endauth
                    @endif

                    <p class="text-center text-muted x-small mt-3 mb-0 italic">Instant confirmation guaranteed</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Typography & Global */
    .fw-black {
        font-weight: 900;
    }

    .x-small {
        font-size: 0.75rem;
    }

    .italic {
        font-style: italic;
    }

    /* Images */
    .img-wrapper img {
        transition: transform 0.4s ease;
    }

    .img-wrapper:hover img {
        transform: scale(1.03);
    }

    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    /* Facilities Badge */
    .badge-facility {
        background: #fff;
        color: #444;
        border: 1px solid #eee;
        padding: 10px 20px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        transition: all 0.3s;
    }

    .badge-facility:hover {
        border-color: #0d6efd;
        color: #0d6efd;
        background: #f8fbff;
    }

    /* Booking Card */
    .booking-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .bg-success-subtle {
        background-color: #e8f5e9 !important;
    }

    .bg-danger-subtle {
        background-color: #ffebee !important;
    }

    /* Button Animation */
    .btn-hover-zoom {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-hover-zoom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2) !important;
    }
</style>
@endsection