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
            <!-- Cart Items -->
            <div class="cart-items">
                <!-- Vendor 1 - Burger King -->
                <div class="vendor-section">
                    <div class="vendor-header">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=100" alt="Burger King" class="vendor-logo">
                        <div>
                            <div class="vendor-name">Burger King</div>
                            <div class="vendor-location"><i class="fas fa-map-marker-alt"></i> Clifton Block 2, Karachi</div>
                        </div>
                    </div>

                    <!-- Item 1 -->
                    <div class="cart-item">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=150" alt="Whopper" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Whopper</div>
                            <div class="item-description">Flame-grilled beef patty with fresh vegetables</div>
                            <div class="item-price">Rs. 450</div>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-controls">
                                <button onclick="decreaseQuantity(1)">-</button>
                                <span id="qty-1">2</span>
                                <button onclick="increaseQuantity(1)">+</button>
                            </div>
                            <div class="remove-item" onclick="removeItem(1)">
                                <i class="fas fa-trash"></i> Remove
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="cart-item">
                        <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=150" alt="French Fries" class="item-image">
                        <div class="item-details">
                            <div class="item-name">French Fries (Large)</div>
                            <div class="item-description">Crispy golden fries</div>
                            <div class="item-price">Rs. 150</div>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-controls">
                                <button onclick="decreaseQuantity(2)">-</button>
                                <span id="qty-2">1</span>
                                <button onclick="increaseQuantity(2)">+</button>
                            </div>
                            <div class="remove-item" onclick="removeItem(2)">
                                <i class="fas fa-trash"></i> Remove
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vendor 2 - Pizza Hut -->
                <div class="vendor-section">
                    <div class="vendor-header">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=100" alt="Pizza Hut" class="vendor-logo">
                        <div>
                            <div class="vendor-name">Pizza Hut</div>
                            <div class="vendor-location"><i class="fas fa-map-marker-alt"></i> DHA Phase 5, Karachi</div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="cart-item">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=150" alt="Pizza" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Pepperoni Pizza (Large)</div>
                            <div class="item-description">Classic pepperoni with extra cheese</div>
                            <div class="item-price">Rs. 1,200</div>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-controls">
                                <button onclick="decreaseQuantity(3)">-</button>
                                <span id="qty-3">1</span>
                                <button onclick="increaseQuantity(3)">+</button>
                            </div>
                            <div class="remove-item" onclick="removeItem(3)">
                                <i class="fas fa-trash"></i> Remove
                            </div>
                        </div>
                    </div>
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
                <!-- Apply Coupon -->
                <div class="summary-card">
                    <div class="coupon-section">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-ticket-alt" style="color: #FFC107; font-size: 1.5rem;"></i>
                            <strong>Apply Coupon</strong>
                        </div>
                        <div class="coupon-input">
                            <input type="text" placeholder="Enter coupon code" id="coupon-input">
                            <button onclick="applyCoupon()">Apply</button>
                        </div>
                    </div>

                    <!-- Applied Coupon (Hidden by default) -->
                    <div class="applied-coupon" id="applied-coupon" style="display: none;">
                        <div>
                            <i class="fas fa-check-circle"></i>
                            <strong id="coupon-code">WELCOME30</strong> applied
                        </div>
                        <span class="remove-coupon" onclick="removeCoupon()">Remove</span>
                    </div>
                </div>

                <!-- Bill Details -->
                <div class="summary-card">
                    <h4>Bill Details</h4>
                    
                    <div class="summary-row">
                        <span class="label">Item Total</span>
                        <span class="value">Rs. 2,250</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="label">Delivery Fee</span>
                        <span class="value">Rs. 80</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="label">Platform Fee</span>
                        <span class="value">Rs. 20</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="label">GST (5%)</span>
                        <span class="value">Rs. 113</span>
                    </div>
                    
                    <div class="summary-row" id="discount-row" style="display: none;">
                        <span class="label">Discount (30%)</span>
                        <span class="value discount">- Rs. 675</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span class="label">To Pay</span>
                        <span class="value" id="total-amount">Rs. 2,463</span>
                    </div>

                    <button class="checkout-btn" onclick="location.href='{{ url('/customer/checkout') }}'">
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

        <!-- Suggestions -->
        <div class="suggestions">
            <h4><i class="fas fa-lightbulb"></i> People also ordered</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="suggestion-item">
                        <img src="https://images.unsplash.com/photo-1554866585-cd94860890b7?w=100" alt="Coke" class="suggestion-image">
                        <div class="suggestion-info">
                            <div class="suggestion-name">Coca Cola (500ml)</div>
                            <div class="suggestion-price">Rs. 80</div>
                        </div>
                        <button class="add-suggestion-btn" onclick="addSuggestion(1)">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="suggestion-item">
                        <img src="https://images.unsplash.com/photo-1562967914-608f82629710?w=100" alt="Onion Rings" class="suggestion-image">
                        <div class="suggestion-info">
                            <div class="suggestion-name">Onion Rings</div>
                            <div class="suggestion-price">Rs. 180</div>
                        </div>
                        <button class="add-suggestion-btn" onclick="addSuggestion(2)">
                            <i class="fas fa-plus"></i> Add
                        </button>
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
@section('scripts')
<script>
    // Quantity control functions
    function increaseQuantity(itemId) {
        const qtyElement = document.getElementById('qty-' + itemId);
        let qty = parseInt(qtyElement.textContent);
        qty++;
        qtyElement.textContent = qty;
        updateTotal();
    }

    function decreaseQuantity(itemId) {
        const qtyElement = document.getElementById('qty-' + itemId);
        let qty = parseInt(qtyElement.textContent);
        if (qty > 1) {
            qty--;
            qtyElement.textContent = qty;
            updateTotal();
        }
    }

    function removeItem(itemId) {
        if (confirm('Are you sure you want to remove this item?')) {
            console.log('Removing item:', itemId);
            alert('Item removed from cart!');
            // Add your remove logic here
        }
    }

    function updateTotal() {
        // Calculate and update total
        console.log('Updating total...');
        // Add your calculation logic here
    }

    // Coupon functions
    function applyCoupon() {
        const couponInput = document.getElementById('coupon-input');
        const couponCode = couponInput.value.toUpperCase();
        
        if (couponCode === 'WELCOME30' || couponCode === 'SAVE50') {
            document.getElementById('applied-coupon').style.display = 'flex';
            document.getElementById('coupon-code').textContent = couponCode;
            document.getElementById('discount-row').style.display = 'flex';
            document.getElementById('total-amount').textContent = 'Rs. 1,788';
            couponInput.value = '';
            alert('Coupon applied successfully!');
        } else {
            alert('Invalid coupon code!');
        }
    }

    function removeCoupon() {
        document.getElementById('applied-coupon').style.display = 'none';
        document.getElementById('discount-row').style.display = 'none';
        document.getElementById('total-amount').textContent = 'Rs. 2,463';
    }

    // Add suggestion to cart
    function addSuggestion(itemId) {
        console.log('Adding suggestion:', itemId);
        alert('Item added to cart!');
        // Add your logic here
    }
</script>
@endsection