    <!-- ======= NAVBAR ======= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="{{ url('/') }}">Sunset Oasis</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-2" aria-current="page" href="{{ route('live') }}">Live with us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" aria-current="page" href="{{ route('rooms.index') }}">Our Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('facilities') }}">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('offers') }}">Special Offers</a>
                    </li>



                </ul>
                @guest
                <form class="d-flex">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none " data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                </form>
                @endguest
                @auth
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        {{-- Thay btn-link bằng btn-borderless hoặc giữ nguyên nhưng thêm cursor pointer --}}
                        <a class="d-flex align-items-center dropdown-toggle text-decoration-none"
                            href="#"
                            role="button"
                            id="userDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer;">

                            <div class="user-avatar me-2">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-lg-inline fw-bold text-dark">{{ Auth::user()->name }}</span>
                        </a>

                        {{-- Menu --}}
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 py-2 mt-3" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('booking.history') }}"><i class="bi bi-clock-history me-2"></i>History</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth

            </div>
        </div>
    </nav>
    {{-- ================= LOGIN MODAL ================= --}}
    @guest
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-person-circle me-2"></i> User Login
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-dark">Login</button>
                            <a href="#" class="text-secondary">
                                Forgot password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= REGISTER MODAL ================= --}}
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-person-lines-fill me-2"></i> User Registration
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-dark">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endguest

    {{-- Auto-open modals when validation errors exist (login vs register) --}}
    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // If old('name') exists it came from registration form
            var modalId = <?php echo json_encode(old('name') ? 'registerModal' : 'loginModal'); ?>;
            var modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        });
    </script>
    a
    @endif

    <style>
        /* Nút Profile gốc */
        .user-profile-btn {
            transition: all 0.2s ease;
        }

        .user-profile-btn::after {
            display: none;
            /* Ẩn dấu mũi tên dropdown mặc định của Bootstrap */
        }

        /* Avatar hình tròn chữ */
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown Menu hiện đại */
        .custom-dropdown-menu {
            min-width: 200px;
            animation: fadeInSlide 0.2s ease-out;
        }

        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-dropdown-menu .dropdown-item {
            font-weight: 500;
            color: #495057;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            transition: all 0.2s;
        }

        .custom-dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            padding-left: 1.5rem;
            /* Hiệu ứng dịch chuyển nhẹ khi hover */
        }

        .custom-dropdown-menu .dropdown-item.text-danger:hover {
            background-color: #fff5f5;
            color: #dc3545;
        }

        .user-name-text {
            font-size: 0.95rem;
            letter-spacing: -0.2px;
        }
    </style>