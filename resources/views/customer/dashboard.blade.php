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

<!-- Popular Products / Restaurants -->
<section class="container mb-5">
    <h2 class="section-title">
        @if($selectedCategory)
            {{ $selectedCategory->category_name }} Products
        @else
            Popular Products Near You
        @endif
    </h2>
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

    <!-- Product Cards -->
    <div class="row">
        @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="vendor-card" onclick="location.href='{{ url('/customer/product-listing') }}'">
                <div style="position: relative;">
                    @if($product->images && $product->images->count() > 0)
                        <!-- Image Carousel -->
                        <div id="carousel-{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="vendor-image d-block w-100">
                                </div>
                                @endforeach
                            </div>
                            <!-- Carousel Controls -->
                            @if($product->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev" onclick="event.stopPropagation()">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next" onclick="event.stopPropagation()">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach($product->images as $index => $image)
                                <button type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide-to="{{ $index }}" 
                                        class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                        aria-label="Slide {{ $index + 1 }}" onclick="event.stopPropagation()"></button>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @else
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400" alt="{{ $product->name }}" class="vendor-image">
                    @endif
                    @if($product->discount_percent > 0)
                        <span class="vendor-badge">{{ $product->discount_percent }}% OFF</span>
                    @endif
                </div>
                <div class="vendor-info">
                    <div class="vendor-name">{{ $product->name }}</div>
                    <div class="vendor-meta">
                        <span class="rating"><i class="fas fa-star"></i> 4.5</span>
                        <span>25-30 mins</span>
                        <span>PKR {{ number_format($product->price) }}</span>
                    </div>
                    <div class="vendor-tags">
                        <span class="tag">{{ $product->category->category_name ?? 'N/A' }}</span>
                        @if($product->vendor && $product->vendor->users)
                            <span class="tag">{{ $product->vendor->users->name }}</span>
                        @endif
                    </div>
                    <div class="delivery-info">
                        <span><i class="fas fa-motorcycle"></i> Free Delivery</span>
                        <span class="text-success"><i class="fas fa-circle"></i> Available</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open" style="font-size: 4rem; color: #ddd;"></i>
            <h4 class="mt-3">No products found</h4>
            <p class="text-muted">Try selecting a different category</p>
        </div>
        @endforelse
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
<style>
    /* Carousel custom styling */
    .carousel-control-prev,
    .carousel-control-next {
        width: 30px;
        height: 30px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        opacity: 0.7;
    }
    
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 15px;
        height: 15px;
    }
    
    .carousel-indicators {
        bottom: 5px;
    }
    
    .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin: 0 3px;
    }
    
    .vendor-image {
        height: 200px;
        object-fit: cover;
    }
</style>
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