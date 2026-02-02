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

    /* CARD */
    .facility-card {
        overflow: hidden;
    }

    /* ROW FLEX */
    .facility-row {
        display: flex;
        align-items: stretch;
    }

    /* IMAGE SIDE */
    .facility-image {
        width: 45%;
        min-height: 100%;
    }

    .facility-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* CONTENT SIDE */
    .facility-content {
        width: 55%;
        padding: 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .facility-content .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .facility-content .card-text {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #555;
    }

    .facility-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 24px;
        justify-items: center;
    }

    .facility-box {
        width: 160px;
        height: 140px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all .25s ease;
    }

    .facility-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
    }

    .facility-box img {
        width: 34px;
        height: 34px;
        margin-bottom: 12px;
    }

    .facility-box span {
        font-size: 0.95rem;
        font-weight: 500;
        color: #333;
        text-align: center;
    }




    /* MOBILE */
    @media (max-width: 768px) {
        .hero-image {
            height: 260px;
        }

        .hero-content h4 {
            font-size: 1.6rem;
        }

        .facility-row {
            flex-direction: column;
        }

        .facility-image,
        .facility-content {
            width: 100%;
        }

        .facility-image {
            height: 220px;
        }

        .facility-content {
            padding: 20px;
        }
    }
</style>
<div class="container-fluid px-lg-4 mt-4">
    <div class="hero-image">
        <img src="{{ asset('images/facilities/1.jpg') }}" alt="Facility Image">

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
                        <button type="submit" class="btn text-white shadow-none custom-bg">Check</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ================= FACILITIES ================= --}}
<div class="container facilities mt-5">
    <div class="col-lg-12 text-center mb-5">
        <h2 class="mb-3">Our Facilities</h2>
        <hr class="w-25 mx-auto">
    </div>
    <div class="row">
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/2.jpg') }}" alt="Fitness Center">
                    </div>

                    <div class="facility-content">
                        <h5 class="card-title">Fitness Center</h5>
                        <p class="card-text">
                            Open daily from 6.00 am until 10.00 pm, our guests have an exclusive access to cardio, strength and functional training machines to maintain a fitness routine. Once the session is over, indulge yourself to the steam room to get the stress away and feel relax.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">
                    <div class="facility-content">
                        <h5 class="card-title">
                            Kids playroom & outdoor playground</h5>
                        <p class="card-text">
                            Ultimate family destination, Diamond Westlake Suites features a playroom with lots of playfulness toys where the little ones can let their imagination foes on. Located in the lobby clubhouse, this is the perfect place for children to play safely while parents are enjoying their breakfast or simply playing at the pool table. The playroom is maintained and tidied on a daily basis.
                            For the most adventurous, our playground offer a large and safe open environment where children can run, play hide and seek, swing or climb the wall-climbing. </p>
                    </div>
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/3.jpg') }}" alt="Fitness Center">
                    </div>

                </div>
            </div>
        </div>
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/4.jpg') }}" alt="Fitness Center">
                    </div>

                    <div class="facility-content">
                        <h5 class="card-title">
                            Meeting room</h5>
                        <p class="card-text">
                            Located on the second floor of the lobby Clubhouse, our private meeting room offers an ideal venue for private meetings, conferences, trainings or brainstorming sessions. With an area of 100 sqm. and a capacity of up to 80 delegates (theater, class room configuration), our meeting room is fully equipped with all the necessary equipment as video projector, wireless microphones, flipchart, stationery …
                            Our dedicated team will gladly assist in providing you with the technical support and tea/coffee break services that will meet your needs. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">

                    <div class="facility-content">
                        <h5 class="card-title">
                            Shuttle bus service</h5>
                        <p class="card-text">
                            For the convenience of our guests, Diamond Westlake Suites offers various complimentary shuttle bus to some international schools, main shopping centers and to Hanoi downtown (four times daily).
                            Download our shuttle bus schedule.
                        </p>
                    </div>
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/5.jpg') }}" alt="Fitness Center">
                    </div>
                </div>
            </div>
        </div>
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/6.jpg') }}" alt="Fitness Center">
                    </div>

                    <div class="facility-content">
                        <h5 class="card-title">

                            Swimming-pool</h5>
                        <p class="card-text">
                            When the heat coming, take a plunge to unwind and relax yourself in one of the biggest outdoor swimming-pool of Hanoi where the surrounding nature will offer you the feeling to stay like in a resort. Exclusively reserved for our guests, cool off in our big, blue swimming-pool until the goes down.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="facility-item mb-4">
            <div class="card shadow border-0 facility-card">
                <div class="facility-row">
                    <div class="facility-content">
                        <h5 class="card-title">
                            Verandah restaurant</h5>
                        <p class="card-text">
                            Open daily from 11.30 am until 10.00 pm (last order at 9.30 pm).

                            Located in the clubhouse, our guests can choose to sit indoor calm or at the outdoor terrace overlooking the West lake. Our menu offers plenty of Japanese, Vietnamese and Western savors, from succulent Vietnamese deep fried spring rolls to classic caesar salad or BBQ pork ribs. All dishes can also be ordered as room service.

                            Breakfast
                            Enjoy our delicious and varied breakfast daily from 6.00 am (Monday to Saturday) and from 7.00 am on Sunday. Guests can savor a wide selection of both western and Vietnamese dishes. Don’t miss our “pho” station ! </p>
                    </div>
                    <div class="facility-image">
                        <img src="{{ asset('images/facilities/7.jpg') }}" alt="Fitness Center">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-5 mb-5">
        <h2 class="mb-3">Other Facilities</h2>
        <hr class="w-25 mx-auto">
    </div>
    <div class="container">
        <div class="facility-grid">
            @forelse ($facilities as $facility)
            <div class="facility-box">
                @if($facility->icon)
                <img src="{{ asset('icons/' . $facility->icon) }}" alt="{{ $facility->name }}">
                @endif
                <span>{{ $facility->name }}</span>
            </div>
            @empty
            <p class="text-muted text-center">No facilities available</p>
            @endforelse
        </div>


    </div>

</div>

@endsection