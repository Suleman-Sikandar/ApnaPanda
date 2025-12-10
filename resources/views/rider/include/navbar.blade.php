<nav class="main-nav bg-dark py-3">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-lg-3 col-md-4">
                <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-motorcycle"></i> Rider Panel
                </a>
            </div>

            <!-- Navigation Menu -->
            <div class="col-lg-6 col-md-5">
                <ul class="nav">
                    @if ($rider->status == 'approved')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('rider/dashboard/'. Auth::id()) }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('rider.profile', Auth::id()) }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Dropdown -->
            <div class="col-lg-3 col-md-3 d-flex justify-content-end align-items-center">
                @auth
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar bg-primary rounded-circle text-center text-white fw-bold"
                                style="width: 34px; height: 34px; line-height:34px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="ms-2 fw-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                            <li>
                                <a class="dropdown-item" href="{{ route('vendor.profile', Auth::id()) }}">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
