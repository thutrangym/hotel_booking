@extends('layouts.app')

@section('content')
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
</style>
<div class="container-fluid px-lg-4 mt-4">
    <div class="hero-image">
        <img src="{{ asset('images/gallery/2.jpg') }}" alt="Special Offers Image">

        <div class="hero-content">
            <h4 class="h-font">Special Offers</h4>
            <p class="h-font">Exclusive deals and packages for your stay</p>
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
{{-- ================= OFFERS ================= --}}
<div class="offers mt-5 mb-5">
    <div class="container justify-content-evenly px-lg-0 px-md-0 px-5">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h3 class="mb-3 fw-bold h-font">Our Special Offers</h3>
                <hr class="mx-auto" style="width: 150px; height: 3px; background-color: #000;">
            </div>
            {{-- Offer Item --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{ asset('images/special_offers/1.jpg') }}" class="card-img-top" alt="Offer 1">
                    <div class="card-body">
                        <h5 class="card-title">Festive Season</h5>
                        <p class="card-text">Enjoy up to 30% off on selected rooms.</p>
                        @auth
                        <a href="{{ route('booking.create', $room->id) }}"
                            class="btn text-white shadow-none custom-bg">
                            Book Now
                        </a>
                        @else
                        <button
                            type="button"
                            class="btn text-white shadow-none custom-bg"
                            onclick="requireLogin()">
                            Book Now
                        </button>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{ asset('images/special_offers/2.jpg') }}" class="card-img-top" alt="Offer 2">
                    <div class="card-body">
                        <h5 class="card-title">Halfboard Package</h5>
                        <p class="card-text">Perfect for families with kids, this package includes kids' meals, family activities, and a special welcome gift.</p>
                        @auth
                        <a href="{{ route('booking.create', $room->id) }}"
                            class="btn text-white shadow-none custom-bg">
                            Book Now
                        </a>
                        @else
                        <button
                            type="button"
                            class="btn text-white shadow-none custom-bg"
                            onclick="requireLogin()">
                            Book Now
                        </button>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{ asset('images/special_offers/3.jpg') }}" class="card-img-top" alt="Offer 3">
                    <div class="card-body">
                        <h5 class="card-title">Advance Purchase</h5>
                        <p class="card-text">Family-friendly deals with kids stay free.</p>
                        @auth
                        <a href="{{ route('booking.create', $room->id) }}"
                            class="btn text-white shadow-none custom-bg">
                            Book Now
                        </a>
                        @else
                        <button
                            type="button"
                            class="btn text-white shadow-none custom-bg"
                            onclick="requireLogin()">
                            Book Now
                        </button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<script>
    function requireLogin() {
        alert('Please login to book a room.');
        const loginModal = new bootstrap.Modal(
            document.getElementById('loginModal')
        );
        loginModal.show();
    }
</script>