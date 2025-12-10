@extends('customer.master')

@section('title', $product->name . ' | ApnaPanda')

@section('navBar')
    @include('customer.includes.navBar')
@endsection

@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')

    <div class="container py-5">
        <div class="row g-4">

            <!-- Left Column: Image Slider -->
            <div class="col-lg-5">
                <div class="product-images-wrapper">
                    <!-- Main Image Display -->
                    <div class="main-image-container">
                        <div class="product-badge-container">
                            @if ($product->discount_percent)
                                <span class="discount-badge">
                                    -{{ $product->discount_percent }}% OFF
                                </span>
                            @endif
                        </div>

                        <div class="product-slider">
                            <div class="slides">
                                @foreach ($product->images as $img)
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $product->name }}"
                                        class="main-product-image">
                                @endforeach
                            </div>
                            <button class="slider-btn prev" aria-label="Previous image"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button class="slider-btn next" aria-label="Next image"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <!-- Thumbnail Navigation -->
                    <div class="thumbnail-container">
                        @foreach ($product->images as $index => $img)
                            <div class="thumbnail {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Details -->
            <div class="col-lg-7">
                <div class="product-info-wrapper">

                    <!-- Store Info -->
                    <div class="store-badge mb-3">
                        <i class="fas fa-store"></i>
                        <span>{{ $product->vendor->business_name ?? 'ApnaPanda Store' }}</span>
                    </div>

                    <!-- Product Title -->
                    <h1 class="product-title mb-3">{{ $product->name }}</h1>

                    <!-- Rating Section -->
                    <div class="rating-section mb-3">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="rating-text">{{ $product->rating }}</span>
                        <span class="review-count">({{ $product->review_count }})</span>
                    </div>

                    <!-- Price Section -->
                    <div class="price-section mb-4">
                        <div class="price-main">
                            <span class="current-price">Rs.
                                {{ number_format($product->price - $product->discount_amount) }}</span>
                            @if ($product->discount_percent)
                                <span class="original-price">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>
                        @if ($product->discount_percent)
                            <div class="savings-text">
                                You save: Rs. {{ number_format($product->discount_amount) }}
                            </div>
                        @endif
                    </div>

                    <!-- Stock Availability -->
                    <div class="stock-section mb-4">
                        <div
                            class="stock-status {{ $product->stock_quantity > 10 ? 'in-stock' : ($product->stock_quantity > 0 ? 'low-stock' : 'out-of-stock') }}">
                            <i class="fas fa-check-circle"></i>
                            <span>
                                @if ($product->stock_quantity > 10)
                                    In Stock
                                @elseif($product->stock_quantity > 0)
                                    Only {{ $product->stock_quantity ?? '10' }} left in stock
                                @else
                                    Out of Stock
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="quantity-section mb-4">
                        <label class="quantity-label">Quantity:</label>
                        <div class="quantity-controls">
                            <button type="button" class="qty-btn qty-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="qty-input" value="1" min="1"
                                max="{{ $product->stock ?? 10 }}" readonly>
                            <button type="button" class="qty-btn qty-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if (Auth::check())
                        <div class="action-buttons mb-4">
                            <form action="{{ url('customer/cart/store/' . $product->id) }}" method="POST"
                                class="d-flex gap-3">
                                @csrf
                                <input type="hidden" name="quantity" class="cart-quantity" value="1">
                                <button type="submit" class="btn-primary-action">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button type="button" class="btn-secondary-action">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>

                        </div>
                    @else
                        <div class="action-buttons mb-4">
                            <button type="button" class="btn-primary-action"
                                onclick="window.location.href='{{ route('login') }}'">
                                <i class="fas fa-sign-in-alt"></i>
                                Login Required To Proceed
                            </button>
                        </div>
                    @endif
                    <!-- Product Features -->
                    <div class="product-features">

                        <div class="feature-item">
                            @if ($product->has_free_delivery == 1)
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <strong>Free Delivery</strong>
                                    <span>On orders over Rs. 2000 PKR</span>
                                </div>
                            @endif
                            @if ($product->has_free_delivery == 0)
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <strong>Delivery Charges</strong>
                                    <span>{{ $product->delivery_charge ?? '200 PKR' }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-undo-alt"></i>
                            <div>
                                <strong>Easy Returns</strong>
                                <span>7 days return policy</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Secure Payment</strong>
                                <span>100% secure transactions</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Product Description Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-details-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#specifications">Specifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews (120)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="description" class="tab-pane active">
                            <div class="tab-content-wrapper">
                                <h3>Product Description</h3>
                                <p>{{ $product->description ?? 'Detailed product description will appear here. This section can include information about the product features, benefits, usage instructions, and any other relevant details that customers should know.' }}
                                </p>
                            </div>
                        </div>
                        <div id="specifications" class="tab-pane fade">
                            <div class="tab-content-wrapper">
                                <h3>Specifications</h3>
                                <p>Product specifications and technical details will be displayed here.</p>
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane fade">
                            <div class="tab-content-wrapper">
                                <h3>Customer Reviews</h3>
                                <p>Customer reviews and ratings will be displayed here.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @include('customer.includes.footer')
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image Slider
            const sliderWrapper = document.querySelector('.product-images-wrapper');
            if (sliderWrapper) {
                const slides = sliderWrapper.querySelector('.slides');
                const images = slides.querySelectorAll('img');
                const thumbnails = sliderWrapper.querySelectorAll('.thumbnail');
                const nextBtn = sliderWrapper.querySelector('.next');
                const prevBtn = sliderWrapper.querySelector('.prev');
                let index = 0;

                function updateSlider(newIndex) {
                    index = newIndex;
                    slides.style.transform = `translateX(-${index * 100}%)`;
                    thumbnails.forEach((thumb, i) => thumb.classList.toggle('active', i === index));
                }

                nextBtn.addEventListener('click', () => updateSlider((index + 1) % images.length));
                prevBtn.addEventListener('click', () => updateSlider((index - 1 + images.length) % images.length));

                thumbnails.forEach((thumb, i) => thumb.addEventListener('click', () => updateSlider(i)));
            }

            // Quantity controls
            const qtyInput = document.querySelector('.qty-input');
            const cartQuantity = document.querySelector('.cart-quantity');
            const qtyPlus = document.querySelector('.qty-plus');
            const qtyMinus = document.querySelector('.qty-minus');

            if (qtyInput && qtyPlus && qtyMinus && cartQuantity) {
                const maxQty = parseInt(qtyInput.getAttribute('max')) || 10;

                function updateQuantity(newVal) {
                    qtyInput.value = newVal;
                    cartQuantity.value = newVal; // sync hidden input
                }

                qtyPlus.addEventListener('click', () => {
                    let val = parseInt(qtyInput.value);
                    if (val < maxQty) updateQuantity(val + 1);
                });

                qtyMinus.addEventListener('click', () => {
                    let val = parseInt(qtyInput.value);
                    if (val > 1) updateQuantity(val - 1);
                });
            }

            // Wishlist button
            const wishlistBtn = document.querySelector('.btn-secondary-action');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', function() {
                    this.querySelector('i').classList.toggle('fas');
                    this.querySelector('i').classList.toggle('far');
                    this.classList.toggle('active');
                });
            }
        });
    </script>
@endpush


<!-- Enhanced CSS -->
<style>
    :root {
        --primary-color: #ff6b6b;
        --primary-hover: #ff5252;
        --secondary-color: #f8f9fa;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e9ecef;
        --success-color: #00b894;
        --warning-color: #fdcb6e;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    /* Product Images Section */
    .product-images-wrapper {
        position: sticky;
        top: 100px;
    }

    .main-image-container {
        position: relative;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 20px;
    }

    .product-badge-container {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }

    .discount-badge {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
    }

    .product-slider {
        position: relative;
        height: 450px;
        overflow: hidden;
    }

    .product-slider .slides {
        display: flex;
        height: 100%;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .main-product-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        z-index: 5;
    }

    .slider-btn:hover {
        background: white;
        box-shadow: var(--shadow-md);
        transform: translateY(-50%) scale(1.1);
    }

    .slider-btn i {
        color: var(--text-dark);
        font-size: 16px;
    }

    .prev {
        left: 15px;
    }

    .next {
        right: 15px;
    }

    /* Thumbnail Navigation */
    .thumbnail-container {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding: 8px 0;
    }

    .thumbnail {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        background: #fff;
        box-shadow: var(--shadow-sm);
    }

    .thumbnail:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }

    .thumbnail.active {
        border-color: var(--primary-color);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info Section */
    .product-info-wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: var(--shadow-md);
    }

    .store-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--secondary-color);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        color: var(--text-light);
    }

    .store-badge i {
        color: var(--primary-color);
    }

    .product-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
        margin: 0;
    }

    /* Rating Section */
    .rating-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stars {
        display: flex;
        gap: 4px;
    }

    .stars i {
        color: #ffc107;
        font-size: 18px;
    }

    .rating-text {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .review-count {
        color: var(--text-light);
        font-size: 14px;
    }

    /* Price Section */
    .price-section {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
        padding: 24px;
        border-radius: 12px;
        border-left: 4px solid var(--primary-color);
    }

    .price-main {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 8px;
    }

    .current-price {
        font-size: 36px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .original-price {
        font-size: 24px;
        color: var(--text-light);
        text-decoration: line-through;
    }

    .savings-text {
        color: var(--success-color);
        font-weight: 600;
        font-size: 14px;
    }

    /* Stock Section */
    .stock-section {
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
    }

    .stock-status.in-stock {
        background: #d4edda;
        color: #155724;
    }

    .stock-status.low-stock {
        background: #fff3cd;
        color: #856404;
    }

    .stock-status.out-of-stock {
        background: #f8d7da;
        color: #721c24;
    }

    /* Quantity Section */
    .quantity-section {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .quantity-label {
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: var(--secondary-color);
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: var(--primary-color);
        color: white;
    }

    .qty-input {
        width: 60px;
        height: 40px;
        border: none;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Action Buttons */
    .action-buttons form {
        width: 100%;
    }

    .btn-primary-action {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(255, 107, 107, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
    }

    .btn-secondary-action {
        width: 56px;
        height: 56px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-secondary-action:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: scale(1.05);
    }

    .btn-secondary-action i {
        font-size: 20px;
    }

    /* Product Features */
    .product-features {
        display: grid;
        gap: 16px;
        padding: 24px;
        background: var(--secondary-color);
        border-radius: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .feature-item i {
        font-size: 24px;
        color: var(--primary-color);
    }

    .feature-item strong {
        display: block;
        color: var(--text-dark);
        font-size: 14px;
        margin-bottom: 2px;
    }

    .feature-item span {
        display: block;
        color: var(--text-light);
        font-size: 13px;
    }

    /* Product Details Tabs */
    .product-details-tabs {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: var(--shadow-md);
    }

    .nav-tabs {
        border-bottom: 2px solid var(--border-color);
    }

    .nav-tabs .nav-link {
        color: var(--text-light);
        font-weight: 600;
        padding: 12px 24px;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
        background: none;
    }

    .tab-content-wrapper {
        padding: 32px 0;
    }

    .tab-content-wrapper h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .tab-content-wrapper p {
        color: var(--text-light);
        line-height: 1.8;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .product-images-wrapper {
            position: static;
            margin-bottom: 30px;
        }

        .product-slider {
            height: 350px;
        }

        .main-product-image {
            height: 350px;
        }

        .product-title {
            font-size: 24px;
        }

        .current-price {
            font-size: 28px;
        }
    }

    @media (max-width: 576px) {
        .product-info-wrapper {
            padding: 20px;
        }

        .action-buttons form {
            flex-direction: column;
        }

        .btn-secondary-action {
            width: 100%;
        }
    }
</style>
