@extends('customer.master')

@section('title', 'Shopping Cart | ApnaPanda')
@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')
    <div class="cart-container">
        <div class="container">
            <h1 class="page-title"><i class="fas fa-shopping-cart"></i> Your Cart</h1>

            <div class="cart-main">

                <div class="cart-items">
                    @if($cart->isEmpty())
                        <div class="text-center py-5">
                            <img src="{{ asset('path/to/empty-cart-image.png') }}" alt="Empty Cart" style="width: 150px; margin-bottom: 20px;">
                            <h2>Your Cart is Empty!</h2>
                            <p>Looks like you haven't added anything to your cart yet.</p>
                            <a href="{{ url('/') }}" class="btn btn-primary mt-3"><i class="fas fa-shopping-basket"></i> Start Shopping</a>
                        </div>
                    @else
                    <div class="vendor-section">
                        <!-- Item 1 -->
                        @foreach ($cart as $cartItem)
                            <div class="cart-item" data-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}" data-discount="{{ $cartItem->product->discount ?? 0 }}">
                                @php
                                    $image = $cartItem->product->images->first()->image_path ?? 'default.jpg';
                                    $displayPrice = $cartItem->price - ($cartItem->price * (optional($cartItem->product)->discount ?? 0) / 100);
                                @endphp

                                <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="item-image">

                                <div class="item-details">
                                    <div class="item-name">{{ optional($cartItem->product)->name ?? 'N/A' }}</div>
                                    <div class="item-price">Rs. <span class="price-value">{{ $displayPrice }}</span></div>
                                </div>

                                <div class="item-actions">
                                    <div class="quantity-controls">
                                        <button class="qty-decrease">-</button>
                                        <span class="qty-value">{{ $cartItem->quantity }}</span>
                                        <button class="qty-increase">+</button>
                                    </div>
                                    <div class="item-total">Rs. <span class="item-total-value">{{ $displayPrice * $cartItem->quantity }}</span></div>
                                    <div class="remove-item deleteProduct" title="Delete Product"
                                            data-id="{{ $cartItem->id }}">
                                        <i class="fas fa-trash"></i> Remove
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>



                    <!-- Add More Items Button -->
                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus"></i> Add More Items
                        </a>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <!-- Bill Details -->
                    <div class="summary-card">
                        <h4>Bill Details</h4>

                        <div class="summary-row">
                            <span class="label">Item Total</span>
                            <span class="value" id="subtotal-amount">Rs. 0</span>
                        </div>

                        <div class="summary-row">
                            <span class="label">Delivery Fee</span>
                            <span class="value" id="delivery-fee">Rs. {{ $deliveryCharge }}</span>
                        </div>

                        <div class="summary-row">
                            <span class="label">GST (5%)</span>
                            <span class="value" id="gst-amount">Rs. 0</span>
                        </div>

                        <div class="summary-row total">
                            <span class="label">To Pay</span>
                            <span class="value" id="total-amount">Rs. 0</span>
                        </div>

                        <button class="checkout-btn" onclick="location.href='{{ url('/customer/checkout/'. optional($cart->first())->id) }}'">
                            Proceed to Checkout <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Safety Info -->
                    <div class="summary-card">
                        <div style="text-align: center;">
                            <i class="fas fa-shield-alt" style="color: #48C774; font-size: 2rem; margin-bottom: 10px;"></i>
                            <h5 style="margin-bottom: 10px;">Safe & Secure</h5>
                            <p style="font-size: 0.85rem; color: #666;">Your payment information is processed securely</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
@endsection


@section('footer')
    @include('customer.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('customer/js/cart.js') }}"></script>
@endpush
