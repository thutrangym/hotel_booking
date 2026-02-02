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