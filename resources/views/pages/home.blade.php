@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    * {
        font-family: 'Playfair Display', sans-serif;
    }

    .h-font {
        font-family: "Gidole", sans-serif;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    /* ===== SWIPER CAROUSEL ===== */
    .swiper {
        width: 100%;
        height: 520px;
        /* desktop */
    }

    @media (max-width: 992px) {
        .swiper {
            height: 380px;
            /* tablet */
        }

        .availability-form {
            margin-top: 0px;
        }
    }

    @media (max-width: 576px) {
        .swiper {
            height: 260px;
            /* mobile */
        }

        .availability-form {
            margin-top: 25px;
            padding: 0 35px;
        }
    }

    .swiper-slide {
        width: 100%;
        height: 100%;
    }

    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* GIỮ TỈ LỆ + CẮT ẢNH */
        object-position: center;
        display: block;
    }

    .custom-bg {
        background-color: #2ec1ac;
        border: 1px solid #2ec1ac;
    }

    .custom-bg:hover {
        background-color: #279e94;
        border-color: #279e94;
    }

    .availability-form {
        margin-top: -50px;
        z-index: 2;
        position: relative;
    }
</style>

<!-- ======= SWIPER CAROUSEL ======= -->
<div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/1.jpg') }}" alt="">

            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/2.jpg') }}" alt="">

            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/3.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/4.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/5.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/carousel/6.jpg') }}" alt="">

            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

    </div>
</div>

<!-- Check availability form -->
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded mt-4">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form action="">
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-in</label>
                        <input type="date" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-out</label>
                        <input type="date" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Adult</label>
                        <select class="form-select shadow-none">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Children</label>
                        <select class="form-select shadow-none">
                            <option value="0">None</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-1 mb-lg-3 d-flex align-items-end">
                        <button type="submit" class="btn text-white shadow-none custom-bg">Check</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Our rooms-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Rooms</h2>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="{{ asset('images/room/1.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5>Family Room with Balcony</h5>
                    <h6 class="mb-4">Price: $100/night</h6>
                    <div class="features mb-4">
                        <h6 class="mb-1">Features</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Room</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Beds</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Bathroom</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>

                    </div>
                    <div class="facilities mb-4">
                        <h6 class="mb-4">Facilities</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
                    </div>
                    <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>

                        <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="{{ asset('images/room/2.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5>Deluxe Double Room</h5>
                    <h6 class="mb-4">Price: $150/night</h6>
                    <div class="features mb-4">
                        <h6 class="mb-1">Features</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Room</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Beds</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Bathroom</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>

                    </div>
                    <div class="facilities mb-4">
                        <h6 class="mb-4">Facilities</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
                    </div>
                    <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>

                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>

                        <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="{{ asset('images/room/3.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5>Premium Double Room with balcony</h5>
                    <h6 class="mb-4">Price: $500/night</h6>
                    <div class="features mb-4">
                        <h6 class="mb-1">Features</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Room</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Beds</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Bathroom</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>

                    </div>
                    <div class="facilities mb-4">
                        <h6 class="mb-4">Facilities</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
                    </div>
                    <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <a href="#" class="btn btn-sm text-white shadow-none custom-bg">Book Now</a>

                        <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-center mt-5">
            <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
        </div>
    </div>

</div>
<!--Our facilities-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>
<div class="container ">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <span><i class="bi bi-wifi"></i></span>
            <div class="card-body">
                <h5 class="mt-3">Wifi</h5>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <span><i class="bi bi-fork-knife"></i></span>
            <div class="card-body">
                <h5 class="mt-3">Restaurant</h5>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <span><i class="bi bi-cart"></i></span>
            <div class="card-body">
                <h5 class="mt-3">Mini mart</h5>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <span><i class="bi bi-car-front"></i></span>
            <div class="card-body">
                <h5 class="mt-3">Car parking</h5>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="{{ route('facilities') }}" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a>
        </div>
    </div>
</div>
<!-- Special Offers -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Special Offers</h2>
<div class="container justify-content-evenly px-lg-0 px-md-0 px-5">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow rounded">
                <img src="{{ asset('images/special_offers/1.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Festive Season</h5>
                    <p class="card-text">Enjoy up to 30% off on selected rooms.</p>
                    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">Details</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow rounded">
                <img src="{{ asset('images/special_offers/2.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Halfboard Package</h5>
                    <p class="card-text">Special weekend rates for couples.</p>
                    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">Details</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow rounded">
                <img src="{{ asset('images/special_offers/3.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Advance Purchase</h5>
                    <p class="card-text">Family-friendly deals with kids stay free.</p>
                    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">Details</a>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- Photo Gallery -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Photo Gallery</h2>
<div class="container">
    <div class="swiper swiper-gallery">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/gallery/1.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/gallery/2.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/gallery/3.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/gallery/4.jpg') }}" alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/gallery/5.jpg') }}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Map -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Find Us</h2>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 p-4 mb-3 bg-white rounded shadow">
            <iframe class="w-100 rounded" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59611.980357559245!2d105.72518385920104!3d20.962601792318065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452efff394ce3%3A0x391a39d4325be464!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBQaGVuaWthYQ!5e0!3m2!1svi!2s!4v1769099849700!5m2!1svi!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="p-4 mb-3 bg-white rounded shadow">
                <h5>Address</h5>
                <p>Phenikaa University, Yen Nghia, Ha Dong, Ha Noi</p>
                <h5>Call us</h5>
                <a href="tel: +84123456789"> <i class="bi bi-telephone-fill"></i> +84 123 456 789</a>
                <h5>Email</h5>
                <a href="mailto:info@example.com"><i class="bi bi-envelope-at-fill"></i> info@example.com</a>
            </div>

            <div class="p-4 mb-3 bg-white rounded shadow">
                <h5>Follow Us</h5>
                <span class="badge bg-light text-dark fs-6 p-2"><a href="#" class="d-inline-block mb-3"><i class="bi bi-facebook me-1"></i> Facebook</a></span>
                <span class="badge bg-light text-dark fs-6 p-2"><a href="#" class="d-inline-block mb-3"><i class="bi bi-instagram me-1"></i> Instagram</a></span>
                <span class="badge bg-light text-dark fs-6 p-2"><a href="#" class="d-inline-block mb-3"><i class="bi bi-twitter me-1"></i> Twitter</a></span>

            </div>

        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- ======= SCRIPTS ======= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        centeredSlides: true,
        autoHeight: false,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper = new Swiper(".swiper-gallery", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",

        },

    });
</script>
@endpush