@extends('customer.master')

@section('title', 'Track Order #12345 | ApnaPanda')

@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')
<div class="tracking-container">
    <div class="container">
        <!-- Success Banner -->
        <div class="success-banner">
            <i class="fas fa-check-circle"></i>
            <h2>Order Confirmed!</h2>
            <p>Your order has been placed successfully. Order ID: <strong>#12345</strong></p>
        </div>

        <div class="tracking-main">
            <!-- Main Content -->
            <div class="tracking-content">
                <!-- Live Tracking -->
                <div class="card">
                    <h3 class="card-title">
                        <i class="fas fa-map-marked-alt text-danger"></i>
                        Live Tracking
                    </h3>

                    <!-- ETA Box -->
                    <div class="eta-box">
                        <i class="fas fa-clock"></i>
                        <div class="eta-time">15 mins</div>
                        <div class="eta-label">Estimated arrival time</div>
                    </div>

                    <!-- Map -->
                    <div class="tracking-map">
                        <div class="map-placeholder">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Real-time map tracking</p>
                            <small>Your rider is on the way!</small>
                        </div>
                    </div>

                    <!-- Rider Info -->
                    <div class="rider-info">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rider" class="rider-avatar">
                        <div class="rider-details">
                            <div class="rider-name">Muhammad Ali</div>
                            <div class="rider-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                4.8
                            </div>
                            <div class="rider-vehicle">
                                <i class="fas fa-motorcycle"></i> Honda CD 70 • ABC-123
                            </div>
                        </div>
                        <div class="rider-actions">
                            <button class="rider-btn call-btn" onclick="callRider()">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button class="rider-btn message-btn" onclick="messageRider()">
                                <i class="fas fa-comment"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Status -->
                <div class="card">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-list text-danger"></i>
                        Order Status
                    </h3>

                    <div class="status-timeline">
                        <div class="status-item completed">
                            <div class="status-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="status-title">Order Placed</div>
                            <div class="status-time">Today, 2:30 PM</div>
                            <div class="status-description">Your order has been received</div>
                        </div>

                        <div class="status-item completed">
                            <div class="status-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="status-title">Order Confirmed</div>
                            <div class="status-time">Today, 2:32 PM</div>
                            <div class="status-description">Restaurant confirmed your order</div>
                        </div>

                        <div class="status-item completed">
                            <div class="status-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="status-title">Preparing Food</div>
                            <div class="status-time">Today, 2:35 PM</div>
                            <div class="status-description">Your food is being prepared with care</div>
                        </div>

                        <div class="status-item active">
                            <div class="status-icon">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <div class="status-title">Out for Delivery</div>
                            <div class="status-time">Today, 2:50 PM</div>
                            <div class="status-description">Your rider is on the way to deliver your order</div>
                        </div>

                        <div class="status-item">
                            <div class="status-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="status-title">Delivered</div>
                            <div class="status-time">Pending</div>
                            <div class="status-description">Enjoy your meal!</div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="card">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-bag text-danger"></i>
                        Order Items
                    </h3>

                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=100" alt="Whopper" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Whopper</div>
                            <div class="item-qty-price">Quantity: 2 × Rs. 450</div>
                        </div>
                        <div class="item-total">Rs. 900</div>
                    </div>

                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=100" alt="Fries" class="item-image">
                        <div class="item-details">
                            <div class="item-name">French Fries (Large)</div>
                            <div class="item-qty-price">Quantity: 1 × Rs. 150</div>
                        </div>
                        <div class="item-total">Rs. 150</div>
                    </div>

                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=100" alt="Pizza" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Pepperoni Pizza (Large)</div>
                            <div class="item-qty-price">Quantity: 1 × Rs. 1,200</div>
                        </div>
                        <div class="item-total">Rs. 1,200</div>
                    </div>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="summary-sidebar">
                <!-- Delivery Address -->
                <div class="card">
                    <h4 class="card-title">
                        <i class="fas fa-map-marker-alt text-danger"></i>
                        Delivery Address
                    </h4>
                    <div class="delivery-address">
                        <span class="address-label">HOME</span>
                        <div class="address-details">
                            <strong>House #123, Street 5</strong><br>
                            Clifton Block 2<br>
                            Karachi, 75600<br>
                            <strong>Phone:</strong> +92 300 1234567
                        </div>
                    </div>
                </div>

                <!-- Bill Summary -->
                <div class="card">
                    <h4 class="card-title">
                        <i class="fas fa-receipt text-danger"></i>
                        Bill Summary
                    </h4>

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
                        <span style="color: #666;">Discount (30%)</span>
                        <span style="font-weight: 600; color: #48C774;">- Rs. 675</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Paid</span>
                        <span>Rs. 1,788</span>
                    </div>

                    <div style="background: #E8F5E9; padding: 10px; border-radius: 8px; margin-top: 15px; text-align: center;">
                        <i class="fas fa-check-circle" style="color: #48C774;"></i>
                        <strong style="color: #2E7D32;"> Paid via Cash on Delivery</strong>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card">
                    <div class="action-buttons">
                        <button class="btn-action btn-help" onclick="getHelp()">
                            <i class="fas fa-headset"></i> Help
                        </button>
                        <button class="btn-action btn-cancel" onclick="cancelOrder()">
                            <i class="fas fa-times-circle"></i> Cancel
                        </button>
                    </div>
                </div>

                <!-- Share Order -->
                <div class="card">
                    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 15px;">
                        Share Tracking Link
                    </h5>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" value="https://apnapanda.com/track/12345" readonly 
                               style="flex: 1; padding: 10px; border: 1px solid #DDD; border-radius: 8px; font-size: 0.85rem;">
                        <button onclick="copyTrackingLink()" 
                                style="background: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                            <i class="fas fa-copy"></i>
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
    function callRider() {
        alert('Calling rider: +92 300 9876543');
        // Implement actual calling functionality
    }

    function messageRider() {
        alert('Opening chat with rider...');
        // Open chat interface
    }

    function getHelp() {
        window.location.href = '{{ url("/support") }}';
    }

    function cancelOrder() {
        if (confirm('Are you sure you want to cancel this order? Cancellation charges may apply.')) {
            alert('Order cancellation request submitted');
            // Implement cancellation logic
        }
    }

    function copyTrackingLink() {
        const input = event.target.closest('div').querySelector('input');
        input.select();
        document.execCommand('copy');
        alert('Tracking link copied to clipboard!');
    }

    // Simulate real-time updates
    function updateOrderStatus() {
        // This would be connected to WebSocket or polling for real-time updates
        console.log('Checking for order updates...');
    }

    // Check for updates every 30 seconds
    setInterval(updateOrderStatus, 30000);
</script>
@endsection