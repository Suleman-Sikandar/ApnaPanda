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
            @if ($selectedCategory)
                {{ $selectedCategory->category_name }} Products
            @else
                Popular Products Near You
            @endif
        </h2>
        <p class="section-subtitle">Discover the best food experiences</p>

        <!-- Filter Bar -->
        <div class="filter-bar d-flex flex-wrap gap-2 mb-4">
            <button class="btn filter-btn active">All</button>
            <button class="btn filter-btn"><i class="fas fa-star"></i> Top Rated</button>
            <button class="btn filter-btn"><i class="fas fa-fire"></i> Fastest Delivery</button>
            <button class="btn filter-btn"><i class="fas fa-tag"></i> Great Offers</button>
            <button class="btn filter-btn"><i class="fas fa-leaf"></i> Pure Veg</button>
            <button class="btn filter-btn"><i class="fas fa-dollar-sign"></i> Under Rs.300</button>
        </div>

        <style>
            /* Updated Product Card */
            .product-card {
                background: #fff;
                border-radius: 14px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
                border: 1px solid #efefef;
                transition: all .25s ease-in-out;
                overflow: hidden;
            }

            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            }

            .product-image-wrapper {
                position: relative;
                height: 180px;
                border-bottom: 1px solid #eee;
                overflow: hidden;
            }

            .product-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: .3s ease;
            }

            .product-card:hover .product-image {
                transform: scale(1.08);
            }

            .discount-badge {
                position: absolute;
                top: 12px;
                left: 12px;
                background: #ff4e4e;
                padding: 5px 10px;
                border-radius: 6px;
                color: #fff;
                font-size: 0.8rem;
                font-weight: 600;
            }

            /* View Detail Button */
            .detail-btn {
                position: absolute;
                bottom: 10px;
                right: 10px;
                background: rgba(0, 0, 0, 0.7);
                padding: 6px 12px;
                color: #fff;
                border-radius: 6px;
                font-size: 0.85rem;
                opacity: 0;
                transition: .3s;
            }

            .product-card:hover .detail-btn {
                opacity: 1;
            }

            /* Product Info */
            .product-info {
                padding: 15px 18px;
            }

            .product-name {
                font-size: 1rem;
                font-weight: 600;
                color: #2c2c2c;
                margin-bottom: 8px;
                transition: .2s ease;
            }

            .product-name-link:hover .product-name {
                color: #ff6f00;
            }

            .product-price-simple .price {
                font-size: 1.1rem;
                font-weight: 700;
                color: #333;
            }

            .product-rating {
                margin-top: 5px;
                display: flex;
                align-items: center;
                gap: 5px;
                color: #ff9500;
                font-size: 0.9rem;
            }

            .delivery-info-simple {
                margin-top: 10px;
                font-size: 0.85rem;
                color: #555;
            }
        </style>

        <!-- Product Cards -->
        <div class="row" id="products-container">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item">
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            @if ($product->images && $product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}" class="product-image">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400"
                                    alt="{{ $product->name }}" class="product-image">
                            @endif

                            @if ($product->discount_percent > 0)
                                <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
                            @elseif($product->discount_amount > 0)
                                <span class="discount-badge">PKR {{ number_format($product->discount_amount) }} OFF</span>
                            @endif

                            <a href="{{ route('customer.product.detail', $product->id) }}" class="detail-btn"><i
                                    class="fas fa-eye"></i> View</a>
                        </div>

                        <div class="product-info">
                            <a href="{{ route('customer.product.detail', $product->id) }}" class="product-name-link">
                                <h5 class="product-name">{{ $product->name }}</h5>
                            </a>

                            <div class="product-price-simple">
                                <span class="price">PKR {{ number_format($product->price) }}</span>
                            </div>

                            @if ($product->rating > 0 || $product->review_count > 0)
                                <div class="product-rating">
                                    <span><i class="fas fa-star"></i> {{ number_format($product->rating, 1) }}</span>
                                    @if ($product->review_count > 0)
                                        <span class="review-count">({{ number_format($product->review_count) }}+)</span>
                                    @endif
                                </div>
                            @endif

                            <div class="delivery-info-simple">
                                @if ($product->has_free_delivery)
                                    <i class="fas fa-shipping-fast"></i> Free Delivery
                                @elseif($product->delivery_charge > 0)
                                    <i class="fas fa-truck"></i> Delivery: PKR
                                    {{ number_format($product->delivery_charge) }}
                                @else
                                    <i class="fas fa-truck"></i> Delivery Available
                                @endif
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

        @if ($products->hasMorePages())
            <div class="text-center mt-4" id="read-more-container">
                <button class="btn btn-primary btn-lg" id="read-more-btn" data-page="2">
                    <i class="fas fa-plus-circle"></i> Read More
                </button>
            </div>
        @endif
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
                        <img src="https://images.unsplash.com/photo-1588964895597-cfccd6e2dbf9?w=400" alt="Grocery"
                            class="vendor-image">
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
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=400" alt="Grocery"
                            class="vendor-image">
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
                        <img src="https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=400" alt="Grocery"
                            class="vendor-image">
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
                        <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=400" alt="Grocery"
                            class="vendor-image">
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
