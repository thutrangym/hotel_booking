<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunset Oasis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Gidole&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

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
            ;
        }

        .custom-bg:hover {
            background-color: #279e94;
        }

        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
    </style>
</head>

<body class="bg-light">
    <!-- ======= NAVBAR ======= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Sunset Oasis</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="#">Live with us</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Apartments
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Four-bedroom apartment</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Three-bedroom Villa</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Two-bedroom apartment</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">One-bedroom apartment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Special Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Photo Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Contact</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none " data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tab>
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center"> <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="button" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot password</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tab>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center"> <i class="bi bi-person-lines-fill fs-3 me-2"></i>

                            User Registration</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">Note: Your details must match with your ID (CCCD, passport, driving license, etc.)
                            that will be required during check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone number</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control shadow-none">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" rows="1"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Date of birth</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>

                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
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

    <br><br><br>
    <!-- ======= SCRIPTS ======= -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            centeredSlides: true,
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
    </script>

</body>

</html>