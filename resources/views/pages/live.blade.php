@extends('layouts.app')

@section('content')
<style>
    .swiper-slide img {
        height: 450px !important;
        width: 100%;
        object-fit: cover;
    }
</style>

{{-- ================= SWIPER CAROUSEL ================= --}}
<div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
        <div class="swiper-wrapper">
            @for ($i = 1; $i <= 5; $i++)
                <div class="swiper-slide">
                <img src="{{ asset('images/carousel/'.$i.'.jpg') }}" alt="">
        </div>
        @endfor
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
</div>

{{-- ================= CHECK AVAILABILITY ================= --}}
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded mt-4">
            <h5 class="mb-4">Check Booking Availability</h5>

            <form>
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Check-in</label>
                        <input type="date" class="form-control shadow-none">
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Check-out</label>
                        <input type="date" class="form-control shadow-none">
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label class="form-label">Adults</label>
                        <select class="form-select shadow-none">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <label class="form-label">Children</label>
                        <select class="form-select shadow-none">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>

                    <div class="col-lg-1 mb-lg-3 d-flex align-items-end">
                        <button class="btn text-white custom-bg w-100">Check</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= INTRODUCE ================= --}}
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4">
            <h2 class="h-font fw-bold">Live with Sunset Oasis</h2>
            <p>
                Nestled in an exceptional location on the fringes of Hanoi’s scenic West lake (Tay Ho), Diamond Westlake Suites is a unique resort-style premium residence offering an exclusive experience with reliable services with over twenty-five years proven track record of stability.
            </p>
            <p>
                Featuring 165 classily furnished serviced suites from one to four-bedroom, the numerous ranges of services, leisure and sport facilities will perfectly match your active lifestyle. Meanwhile, the surrounding scenic and lavish nature will make you feel like in a resort, offering a feeling of smooth and unhurried style of living. Make the most of the landscaping and bespoke green space whilst enjoying the comfort of your apartments. </p>
            <p>Safe and family oriented through a wide varieties of activities and events all year-long, you will also find multiple nearby restaurants, cafes and retail shops which whom we’ve partnered to offer you the most of your stay in Hanoi.</p>
        </div>

        <div class="col-lg-6">
            <img src="{{ asset('images/about/1.jpg') }}" class="img-fluid rounded shadow">
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-lg-6">
            <img src="{{ asset('images/about/1.jpg') }}" class="img-fluid rounded shadow">
        </div>
        <div class="col-lg-6 mb-4">
            <p>
                Stay at Diamond Westlake Suites to experience a resort-style living experience at the gates of Hanoi Capital. Indulge yourself in an oasis of calm and serene where the green lush will bring moments of relaxation away from the bustling of the city. Perfect destination for relocating families in Hanoi, the playground will become the best playmate of your children, evolving in a safe and attentioned environment.
            </p>
            <p>
                Featuring 165 suites, most apartments offer a private balcony, boasting stunning lake view and / or swimming-pool view. All apartments are equipped with fully equipped kitchen, centralized air-conditionning, 55″ smart TV, convenient separate spaces to eat, rest, sleep and work. Complimentary wifi is accessible from the apartment and all public areas and a complimentary car park is allocated during your stay. </p>
            <p>Continental buffet breakfast options with warm and cold dishes, local and international specialties and fresh pastries are served daily in our Verandah restaurant. “À la carte” lunch and dinner are also available dine-in and room service.</p>
            <p>Ideally located on the Quang An peninsula and overlooking the West lake, Diamond Westlake Suites benefits of a privileged situation in a residential area coveted by relocating families. Discover plenty of dining restaurants and retail shops in the surroundings while most of international schools can be accessible by shuttle. The Hanoi Old Quarter that is served daily by our complimentary shuttle bus is only 20′ away while it will take you less than 30 minutes to reach Noi Bai International airport.</p>
        </div>


    </div>
</section>
<style>
    section.container p {
        color: #555;
        line-height: 1.8;
        font-size: 15px;
    }

    section.container img {
        border-radius: 16px;
    }
</style>


{{-- ================= ROOMS ================= --}}
<div class="apartment-card">
    <div class="apartment-left">
        <h2>Rooms</h2>

        <p>
            Discover our stylish suites that will answer all your needs.
            From one to four-bedroom apartments, we provide accommodations
            suitable for all types of trips whether you are business or leisure
            travelling for short or long-term stay in Hanoi.
        </p>

        <a href="#" class="btn-detail">MORE DETAIL</a>
    </div>

    <div class="apartment-right">
        <div class="feature">
            <span>🛁</span> Bathtub
        </div>
        <div class="feature">
            <span>👁️</span> Lake view
        </div>
        <div class="feature">
            <span>🌿</span> Garden view
        </div>
        <div class="feature">
            <span>❄️</span> Centralized air-conditioning
        </div>
        <div class="feature">
            <span>🍽️</span> Fully-equipped kitchen
        </div>
        <div class="feature">
            <span>💻</span> Working desk
        </div>
        <div class="feature">
            <span>📺</span> 55” LED Smart TV
        </div>
        <div class="feature">
            <span>🧺</span> Washer & dryer
        </div>
    </div>
</div>
<style>
    .apartment-card {
        max-width: 1100px;
        margin: 40px auto;
        padding: 40px;

        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);

        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 40px;
    }

    /* LEFT */
    .apartment-left h2 {
        font-size: 36px;
        margin-bottom: 16px;
    }

    .apartment-left p {
        color: #555;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .btn-detail {
        display: inline-block;
        padding: 12px 28px;
        background: #7fd1d8;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
    }

    /* RIGHT */
    .apartment-right {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px 24px;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #333;
    }

    .feature span {
        font-size: 18px;
    }
</style>

{{-- ================= PHOTO GALLERY ================= --}}
<section class="container pb-5">
    <h2 class="text-center h-font fw-bold mb-4">Photo Gallery</h2>

    <div class="swiper swiper-gallery">
        <div class="swiper-wrapper">
            @for ($i = 1; $i <= 6; $i++)
                <div class="swiper-slide">
                <img src="{{ asset('images/gallery/'.$i.'.jpg') }}" alt="">
        </div>
        @endfor
    </div>
    <div class="swiper-pagination"></div>
    </div>
</section>


@endsection
@push('scripts')
<script>
    new Swiper(".swiper-container", {
        loop: true,
        effect: "fade",
        autoplay: {
            delay: 2500
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        }
    });

    new Swiper(".swiper-gallery", {
        slidesPerView: "auto",
        spaceBetween: 20,
        centeredSlides: true,
        pagination: {
            el: ".swiper-pagination"
        }
    });
</script>
@endpush