@extends('customer.master')

@section('title', 'ApnaPanda - Order Food, Groceries & More')

@section('topBar')
    @include('customer.includes.topBar')
@endsection

@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection
@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1>Order Food & Groceries Delivered to Your Door</h1>
                <p>Fast delivery from your favorite restaurants and stores</p>
                <div class="hero-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter your delivery address">
                        <button class="btn" type="button">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="container mb-5">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="service-card">
                <i class="fas fa-utensils"></i>
                <h5>Food Delivery</h5>
                <p>Order from 1000+ restaurants</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="service-card">
                <i class="fas fa-shopping-basket"></i>
                <h5>Grocery</h5>
                <p>Fresh groceries in minutes</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="service-card">
                <i class="fas fa-pills"></i>
                <h5>Pharmacy</h5>
                <p>Medicines at your doorstep</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="service-card">
                <i class="fas fa-box"></i>
                <h5>Parcel</h5>
                <p>Send packages anywhere</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Restaurants -->
<section class="container mb-5">
    <h2 class="section-title">Popular Restaurants Near You</h2>
    <p class="section-subtitle">Discover the best food experiences</p>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <button class="btn filter-btn active">All</button>
        <button class="btn filter-btn"><i class="fas fa-star"></i> Top Rated</button>
        <button class="btn filter-btn"><i class="fas fa-fire"></i> Fastest Delivery</button>
        <button class="btn filter-btn"><i class="fas fa-tag"></i> Great Offers</button>
        <button class="btn filter-btn"><i class="fas fa-leaf"></i> Pure Veg</button>
        <button class="btn filter-btn"><i class="fas fa-dollar-sign"></i> Under Rs.300</button>
    </div>

    <!-- Vendor Cards -->
    <div class="row">
        <!-- Vendor 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/customer/product-listing') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">30% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Burger King</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.5</span>
                        <span>25-30 mins</span>
                        <span>Rs.150 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Burgers</span>
                        <span class="tag">Fast Food</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/2') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">FREE DELIVERY</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Pizza Hut</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.3</span>
                        <span>30-35 mins</span>
                        <span>Rs.400 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Pizza</span>
                        <span class="tag">Italian</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 3 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/3') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">50% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Biryani House</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.7</span>
                        <span>20-25 mins</span>
                        <span>Rs.200 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Biryani</span>
                        <span class="tag">Pakistani</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Rs.50</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 4 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/4') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">20% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Sushi Bar</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.6</span>
                        <span>35-40 mins</span>
                        <span>Rs.800 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Sushi</span>
                        <span class="tag">Japanese</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 5 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/5') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">40% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Karachi Cafe</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.4</span>
                        <span>15-20 mins</span>
                        <span>Rs.250 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Desi</span>
                        <span class="tag">BBQ</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Rs.30</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 6 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/6') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">FREE DELIVERY</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Domino's Pizza</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.2</span>
                        <span>30-35 mins</span>
                        <span>Rs.500 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Pizza</span>
                        <span class="tag">Fast Food</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 7 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/7') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">25% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Salad Stop</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.8</span>
                        <span>20-25 mins</span>
                        <span>Rs.350 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Healthy</span>
                        <span class="tag">Salads</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Rs.40</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor 8 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/8') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400" alt="Restaurant" class="vendor-image">
                    <span class="vendor-badge">35% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Burger Lab</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.5</span>
                        <span>25-30 mins</span>
                        <span>Rs.300 for two</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Burgers</span>
                        <span class="tag">Wraps</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promotional Banner -->
<section class="container">
    <div class="promo-banner">
        <h3>🎉 Get 50% OFF on your first order!</h3>
        <p class="mb-4">Use code: WELCOME50 | Valid for new users only</p>
        <button class="btn">Order Now</button>
    </div>
</section>

<!-- Grocery Section -->
<section class="container mb-5">
    <h2 class="section-title">Fresh Groceries Delivered</h2>
    <p class="section-subtitle">Get fresh fruits, vegetables, and daily essentials</p>

    <div class="row">
        <!-- Grocery Store 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/9') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1588964895597-cfccd6e2dbf9?w=400" alt="Grocery" class="vendor-image">
                    <span class="vendor-badge">10% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Fresh Mart</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.6</span>
                        <span>30-40 mins</span>
                        <span>Min Rs.500</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Groceries</span>
                        <span class="tag">Vegetables</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free above Rs.1000</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grocery Store 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/10') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=400" alt="Grocery" class="vendor-image">
                    <span class="vendor-badge">FREE DELIVERY</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Imtiaz Super Market</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.4</span>
                        <span>40-50 mins</span>
                        <span>Min Rs.800</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Groceries</span>
                        <span class="tag">Household</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grocery Store 3 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/11') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=400" alt="Grocery" class="vendor-image">
                    <span class="vendor-badge">15% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Al-Fatah</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.5</span>
                        <span>35-45 mins</span>
                        <span>Min Rs.600</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Groceries</span>
                        <span class="tag">Dairy</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Rs.60</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grocery Store 4 -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/vendor/12') }}'">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=400" alt="Grocery" class="vendor-image">
                    <span class="vendor-badge">20% OFF</span>
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">Metro Cash & Carry</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.3</span>
                        <span>50-60 mins</span>
                        <span>Min Rs.1000</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">Bulk</span>
                        <span class="tag">Wholesale</span>
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free above Rs.2000</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Open</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
    @include('customer.includes.footer')
@endsection
@section('scripts')
<script>
    // Search functionality
    document.querySelector('.hero-search input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchVendors();
        }
    });

    function searchVendors() {
        const searchTerm = document.querySelector('.hero-search input').value;
        console.log('Searching for:', searchTerm);
        // Add your search logic here
    }

    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            console.log('Filter selected:', this.textContent);
            // Add your filter logic here
        });
    });
</script>
@endsection