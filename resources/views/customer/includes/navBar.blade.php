 <nav class="main-nav">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-2 col-md-3">
                 <a class="navbar-brand" href="{{ url('/customer/home') }}">
                     <i class="fas fa-utensils"></i> ApnaPanda
                 </a>
             </div>
             <div class="col-lg-6 col-md-5">
                 <div class="nav-search">
                     <input type="text" class="form-control"
                         placeholder="Search for restaurants, groceries, pharmacy...">
                 </div>
             </div>
             <div class="col-lg-4 col-md-4">
                 <div class="nav-icons d-flex justify-content-end align-items-center gap-3">
                     @guest
                         <a href="{{ url('/login') }}" class="text-decoration-none">
                             <i class="fas fa-sign-in-alt"></i> Login
                         </a>
                         <a href="{{ url('/register') }}" class="text-decoration-none">
                             <i class="fas fa-user-plus"></i> Sign Up
                         </a>
                     @else
                         <div class="dropdown d-inline-block">
                             <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown"
                                 style="display:flex; align-items:center;">
                                 <div class="user-avatar rounded-circle bg-danger text-white text-center"
                                     style="width:32px; height:32px; line-height:32px; font-weight:bold;">
                                     {{ substr(Auth::user()->name, 0, 1) }}
                                 </div>
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li><a class="dropdown-item" href="{{ url('/customer/profile/'.Auth::user()->id) }}"><i
                                             class="fas fa-user"></i> My Profile</a></li>
                                 <li><a class="dropdown-item" href="{{ url('/customer/orders') }}"><i
                                             class="fas fa-box"></i> My Orders</a></li>
                                 <li><a class="dropdown-item" href="{{ url('/addresses') }}"><i
                                             class="fas fa-map-marker-alt"></i> Addresses</a></li>
                                 <li><a class="dropdown-item" href="{{ url('/wallet') }}"><i class="fas fa-wallet"></i>
                                         Wallet</a></li>
                                 <li>
                                     <hr class="dropdown-divider">
                                 </li>
                                 <li>
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                         <i class="fas fa-sign-out-alt"></i> Logout
                                     </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                         @csrf
                                     </form>
                                 </li>
                             </ul>
                         </div>

                          <a href="{{ url('/customer/all-cart/'. Auth::id()) }}" class="position-relative">
                         <i class="fas fa-shopping-cart fa-lg"></i>
                         <span
                             class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                             style="font-size:0.65rem;">
                            {{ cartTotal() }}
                         </span>
                     </a>   
                     @endguest

                    
                 </div>
             </div>

         </div>
     </div>
 </nav>
