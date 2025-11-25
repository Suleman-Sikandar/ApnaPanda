<nav class="main-nav bg-dark py-3">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Logo -->
            <div class="col-lg-3 col-md-4">
                <a class="navbar-brand text-white fw-bold" href="{{ url('/vendor/dashboard') }}">
                    <i class="fas fa-store"></i> Vendor Panel
                </a>
            </div>

            <!-- Navigation Menu -->
            <div class="col-lg-6 col-md-5">
               
            </div>

            <!-- User Dropdown -->
            <div class="col-lg-3 col-md-3 d-flex justify-content-end align-items-center">
                
                @auth
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-decoration-none text-white d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="user-avatar bg-danger rounded-circle text-center text-white fw-bold"
                             style="width: 34px; height: 34px; line-height:34px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="ms-2 fw-semibold">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
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
