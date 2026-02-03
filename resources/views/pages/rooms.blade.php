@extends('layouts.app')

@section('content')

{{-- ================= HERO STYLE ================= --}}
<style>
    .hero-image {
        position: relative;
        width: 100%;
        height: 420px;
        overflow: hidden;
    }

    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 2;
    }

    .hero-content h4 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .hero-content p {
        font-size: 2rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .hero-image {
            height: 260px;
        }

        .hero-content h4 {
            font-size: 1.6rem;
        }
    }
</style>

{{-- ================= HERO ================= --}}
<div class="container-fluid px-lg-4 mt-4">
    <div class="hero-image">
        <img src="{{ asset('images/facilities/1.jpg') }}" alt="Hotel Banner">

        <div class="hero-content">
            <h4 class="h-font">Cherish the moment</h4>
            <p class="h-font">Elegant living with an iconic view</p>
        </div>
    </div>
</div>

{{-- ================= CHECK AVAILABILITY ================= --}}
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded mt-4">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form method="GET" action="{{ route('rooms.index') }}">
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Check-in</label>
                        <input type="date" name="check_in" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Check-out</label>
                        <input type="date" name="check_out" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Person</label>
                        <select name="adults" class="form-select shadow-none">
                            @for($i=1;$i<=4;$i++)
                                <option>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="col-lg-1 mb-lg-3">
                        <button class="btn text-white shadow-none custom-bg">Check</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= ROOM LIST ================= --}}
<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Rooms List</h2>

        {{-- STATUS FILTER --}}
        <form method="GET" class="d-flex gap-2">
            @foreach(request()->except('status','page') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <select name="status" class="form-select">
                <option value="">-- Status --</option>
                <option value="available" {{ request('status')=='available'?'selected':'' }}>Available</option>
                <option value="occupied" {{ request('status')=='occupied'?'selected':'' }}>Occupied</option>
                <option value="reserved" {{ request('status')=='reserved'?'selected':'' }}>Reserved</option>
                <option value="maintenance" {{ request('status')=='maintenance'?'selected':'' }}>Maintenance</option>
            </select>

            <button class="btn btn-primary">Filter</button>
        </form>
    </div>

    {{-- ROOMS --}}
    <div class="row">
        @forelse ($rooms as $room)
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">

                {{-- IMAGE --}}
                <img
                    src="{{ $room->image
                        ? asset('storage/'.$room->image)
                        : asset('images/room-default.jpg') }}"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    {{-- ROOM NAME --}}
                    <h5 class="mb-1">{{ $room->name }}</h5>

                    {{-- PRICE --}}
                    <h6 class="mb-4 text-muted">
                        Price: {{ number_format($room->price) }} VND / night
                    </h6>

                    {{-- FACILITIES --}}
                    <div class="facilities mb-4">
                        <h6 class="mb-3">Facilities</h6>

                        @forelse ($room->facilities as $facility)
                        <span class="badge bg-light text-dark me-2 mb-2">
                            @if($facility->icon)
                            <img
                                src="{{ asset('icons/' . $facility->icon) }}"
                                width="16"
                                class="me-1">
                            @endif
                            {{ $facility->name }}
                        </span>
                        @empty
                        <span class="text-muted">No facilities available</span>
                        @endforelse
                    </div>


                    {{-- RATING (STATIC / DEMO) --}}
                    <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            @for($i = 0; $i < 5; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                        </span>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-evenly mb-2">

                        @if($room->status === 'available')

                        @auth
                        {{-- USER: đi tới trang booking --}}
                        <a
                            href="{{ route('booking.create', $room->id) }}"
                            class="btn btn-sm text-white shadow-none custom-bg">
                            Book Now
                        </a>
                        @else
                        {{-- GUEST: mở modal login --}}
                        <button
                            type="button"
                            class="btn btn-sm text-white shadow-none custom-bg"
                            onclick="requireLogin()">
                            Book Now
                        </button>
                        @endauth

                        @else
                        <button
                            class="btn btn-sm btn-secondary shadow-none"
                            disabled>
                            Not Available
                        </button>
                        @endif

                        {{-- More details vẫn giữ --}}
                        <a
                            href="{{ route('rooms.show', $room) }}"
                            class="btn btn-sm btn-outline-dark shadow-none">
                            More Details
                        </a>

                    </div>


                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No rooms available.
            </div>
        </div>
        @endforelse
    </div>


    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $rooms->withQueryString()->links() }}
    </div>

</div>
@endsection

<script>
    function requireLogin() {
        alert('Please login to book a room.');

        const loginModalEl = document.getElementById('loginModal');
        if (loginModalEl) {
            const loginModal = new bootstrap.Modal(loginModalEl);
            loginModal.show();
        }
    }
</script>