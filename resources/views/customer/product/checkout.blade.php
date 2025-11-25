@extends('customer.master')

@section('title', 'Checkout | ApnaPanda')
@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')
<div class="checkout-container">
    <div class="container">
        <!-- Progress Steps -->
        <div class="checkout-steps">
            <div class="steps">
                <div class="step completed">
                    <div class="step-circle">✓</div>
                    <div class="step-label">Cart</div>
                    <div class="step-line"></div>
                </div>
                <div class="step active">
                    <div class="step-circle">2</div>
                    <div class="step-label">Address & Payment</div>
                    <div class="step-line"></div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Confirmation</div>
                </div>
            </div>
        </div>

        <div class="checkout-main">
            <!-- Checkout Content -->
            <div class="checkout-content">
                <!-- Delivery Address -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-map-marker-alt text-danger"></i> Delivery Address
                        </h3>
                    </div>

                    <div class="address-grid">
                        <!-- Address 1 -->
                        <div class="address-card selected" onclick="selectAddress(1)">
                            <span class="address-type">HOME</span>
                            <div class="address-details">
                                <strong>House #123, Street 5</strong><br>
                                Clifton Block 2<br>
                                Karachi, 75600<br>
                                <strong>Phone:</strong> +92 300 1234567
                            </div>
                        </div>

                        <!-- Address 2 -->
                        <div class="address-card" onclick="selectAddress(2)">
                            <span class="address-type" style="background: #4ECDC4;">WORK</span>
                            <div class="address-details">
                                <strong>Office Tower, 5th Floor</strong><br>
                                DHA Phase 5<br>
                                Karachi, 75500<br>
                                <strong>Phone:</strong> +92 300 7654321
                            </div>
                        </div>

                        <!-- Address 3 -->
                        <div class="address-card" onclick="selectAddress(3)">
                            <span class="address-type" style="background: #95E1D3;">OTHER</span>
                            <div class="address-details">
                                <strong>Apartment 4B</strong><br>
                                Gulshan-e-Iqbal<br>
                                Karachi, 75300<br>
                                <strong>Phone:</strong> +92 300 9876543
                            </div>
                        </div>

                        <!-- Add New Address -->
                        <div class="address-card add-address-card" onclick="addNewAddress()">
                            <i class="fas fa-plus-circle"></i>
                            <strong>Add New Address</strong>
                        </div>
                    </div>
                </div>

                <!-- Delivery Instructions -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-clipboard-list text-danger"></i> Delivery Instructions
                        </h3>
                    </div>
                    <textarea class="delivery-notes" placeholder="Any specific delivery instructions? (e.g., Ring the doorbell, Call on arrival, Leave at door)"></textarea>
                </div>

                <!-- Payment Method -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-credit-card text-danger"></i> Payment Method
                        </h3>
                    </div>

                    <!-- Cash on Delivery -->
                    <div class="payment-method selected" onclick="selectPayment(1)">
                        <div class="payment-icon" style="background: #E8F5E9;">
                            <i class="fas fa-money-bill-wave" style="color: #48C774;"></i>
                        </div>
                        <div class="payment-info">
                            <div class="payment-name">Cash on Delivery</div>
                            <div class="payment-description">Pay with cash when your order arrives</div>
                        </div>
                        <div class="radio-check"></div>
                    </div>

                    <!-- Credit/Debit Card -->
                    <div class="payment-method" onclick="selectPayment(2)">
                        <div class="payment-icon" style="background: #E3F2FD;">
                            <i class="fas fa-credit-card" style="color: #2196F3;"></i>
                        </div>
                        <div class="payment-info">
                            <div class="payment-name">Credit / Debit Card</div>
                            <div class="payment-description">Pay securely with your card</div>
                        </div>
                        <div class="radio-check"></div>
                    </div>

                    <!-- Digital Wallet -->
                    <div class="payment-method" onclick="selectPayment(3)">
                        <div class="payment-icon" style="background: #FFF3E0;">
                            <i class="fas fa-wallet" style="color: #FF9800;"></i>
                        </div>
                        <div class="payment-info">
                            <div class="payment-name">ApnaPanda Wallet</div>
                            <div class="payment-description">Current Balance: Rs. 1,500</div>
                        </div>
                        <div class="radio-check"></div>
                    </div>

                    <!-- JazzCash -->
                    <div class="payment-method" onclick="selectPayment(4)">
                        <div class="payment-icon" style="background: #FFEBEE;">
                            <i class="fas fa-mobile-alt" style="color: #F44336;"></i>
                        </div>
                        <div class="payment-info">
                            <div class="payment-name">JazzCash / EasyPaisa</div>
                            <div class="payment-description">Pay with mobile wallet</div>
                        </div>
                        <div class="radio-check"></div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="section-card">
                    <label style="display: flex; align-items: start; gap: 10px; cursor: pointer;">
                        <input type="checkbox" id="terms" style="margin-top: 4px;">
                        <span style="font-size: 0.9rem; color: #666;">
                            I agree to the <a href="#" style="color: var(--primary-color);">Terms & Conditions</a> 
                            and <a href="#" style="color: var(--primary-color);">Privacy Policy</a>. 
                            I also agree to receive promotional messages and updates from ApnaPanda.
                        </span>
                    </label>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-card">
                    <h4>Order Summary</h4>

                    <!-- Order Items -->
                    <div class="order-item">
                        <span class="item-name">Whopper</span>
                        <span class="item-qty">× 2</span>
                        <span class="item-price">Rs. 900</span>
                    </div>

                    <div class="order-item">
                        <span class="item-name">French Fries (Large)</span>
                        <span class="item-qty">× 1</span>
                        <span class="item-price">Rs. 150</span>
                    </div>

                    <div class="order-item">
                        <span class="item-name">Pepperoni Pizza (Large)</span>
                        <span class="item-qty">× 1</span>
                        <span class="item-price">Rs. 1,200</span>
                    </div>

                    <div class="summary-divider"></div>

                    <!-- Bill Details -->
                    <div class="summary-row">
                        <span style="color: #666;">Item Total</span>
                        <span style="font-weight: 600;">Rs. 2,250</span>
                    </div>

                    <div class="summary-row">
                        <span style="color: #666;">Delivery Fee</span>
                        <span style="font-weight: 600;">Rs. 80</span>
                    </div>

                    <div class="summary-row">
                        <span style="color: #666;">Platform Fee</span>
                        <span style="font-weight: 600;">Rs. 20</span>
                    </div>

                    <div class="summary-row">
                        <span style="color: #666;">GST (5%)</span>
                        <span style="font-weight: 600;">Rs. 113</span>
                    </div>

                    <div class="summary-row">
                        <span style="color: #666;">Discount</span>
                        <span style="font-weight: 600; color: #48C774;">- Rs. 675</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Amount</span>
                        <span>Rs. 1,788</span>
                    </div>

                    <a href="{{ url('customer/tracking') }}" class="place-order-btn" onclick="placeOrder()">
                        <i class="fas fa-check-circle"></i> Place Order
                    </a>

                    <div style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: #666;">
                        <i class="fas fa-shield-alt" style="color: #48C774;"></i>
                        Your payment is 100% secure
                    </div>
                </div>

                <!-- Cancellation Policy -->
                <div class="summary-card" style="margin-top: 15px;">
                    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 10px;">
                        <i class="fas fa-info-circle" style="color: #FF9800;"></i> Cancellation Policy
                    </h5>
                    <p style="font-size: 0.85rem; color: #666; line-height: 1.6; margin: 0;">
                        Orders cannot be cancelled once packed for delivery. In case of unexpected delays, a refund will be provided, if applicable.
                    </p>
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
    let selectedAddress = 1;
    let selectedPayment = 1;

    function selectAddress(addressId) {
        selectedAddress = addressId;
        document.querySelectorAll('.address-card').forEach(card => {
            card.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        console.log('Selected address:', addressId);
    }

    function selectPayment(paymentId) {
        selectedPayment = paymentId;
        document.querySelectorAll('.payment-method').forEach(method => {
            method.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        console.log('Selected payment:', paymentId);
    }

    function addNewAddress() {
        alert('Opening address form...');
        // Open modal or redirect to address form
    }

    function placeOrder() {
        const termsChecked = document.getElementById('terms').checked;
        
        if (!termsChecked) {
            alert('Please accept the Terms & Conditions to continue');
            return;
        }

        console.log('Placing order with:');
        console.log('Address ID:', selectedAddress);
        console.log('Payment ID:', selectedPayment);

        // Show loading state
        const btn = event.currentTarget;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

        // Simulate order placement
        setTimeout(() => {
            window.location.href = '{{ url("/order-tracking/12345") }}';
        }, 2000);
    }
</script>
@endsection