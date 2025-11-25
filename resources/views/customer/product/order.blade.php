@extends('customer.master')

@section('title', 'My Orders | ApnaPanda')
@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')
<div class="orders-container">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-shopping-bag"></i> My Orders
            </h1>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #E8F5E9;">
                        <i class="fas fa-check-circle" style="color: #48C774;"></i>
                    </div>
                    <div class="stat-value">48</div>
                    <div class="stat-label">Completed Orders</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #FFF3E0;">
                        <i class="fas fa-clock" style="color: #FF9800;"></i>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Active Orders</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #E3F2FD;">
                        <i class="fas fa-wallet" style="color: #2196F3;"></i>
                    </div>
                    <div class="stat-value">Rs. 24,500</div>
                    <div class="stat-label">Total Spent</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #FCE4EC;">
                        <i class="fas fa-star" style="color: #E91E63;"></i>
                    </div>
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Average Rating</div>
                </div>
            </div>

            <!-- Order Tabs -->
            <div class="order-tabs">
                <button class="tab-btn active" onclick="filterOrders('all')">
                    All Orders
                </button>
                <button class="tab-btn" onclick="filterOrders('active')">
                    Active Orders
                </button>
                <button class="tab-btn" onclick="filterOrders('delivered')">
                    Delivered
                </button>
                <button class="tab-btn" onclick="filterOrders('cancelled')">
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Order List -->
        <div id="orders-list">
            <!-- Active Order 1 -->
            <div class="order-card" data-status="active">
                <div class="order-header">
                    <div class="order-info">
                        <div class="order-id">Order #12345</div>
                        <div class="order-date">
                            <i class="far fa-clock"></i> Today, 2:30 PM
                        </div>
                    </div>
                    <span class="order-status status-on-the-way">
                        <i class="fas fa-motorcycle"></i> On the Way
                    </span>
                </div>

                <div class="vendor-info">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=100" alt="Burger King" class="vendor-logo">
                    <div>
                        <div class="vendor-name">Burger King</div>
                        <div class="vendor-location">
                            <i class="fas fa-map-marker-alt"></i> Clifton Block 2, Karachi
                        </div>
                    </div>
                </div>

                <div class="order-items">
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=100" alt="Whopper" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Whopper</div>
                            <div class="item-qty">Qty: 2</div>
                        </div>
                        <div class="item-price">Rs. 900</div>
                    </div>
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=100" alt="Fries" class="item-image">
                        <div class="item-details">
                            <div class="item-name">French Fries (Large)</div>
                            <div class="item-qty">Qty: 1</div>
                        </div>
                        <div class="item-price">Rs. 150</div>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="order-total-label">Total:</span>
                        <span class="order-total-amount">Rs. 1,788</span>
                    </div>
                    <div class="order-actions">
                        <button class="btn-order btn-primary" onclick="trackOrder('12345')">
                            <i class="fas fa-map-marked-alt"></i> Track Order
                        </button>
                        <button class="btn-order btn-outline" onclick="viewDetails('12345')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Order 2 -->
            <div class="order-card" data-status="active">
                <div class="order-header">
                    <div class="order-info">
                        <div class="order-id">Order #12344</div>
                        <div class="order-date">
                            <i class="far fa-clock"></i> Today, 1:15 PM
                        </div>
                    </div>
                    <span class="order-status status-preparing">
                        <i class="fas fa-utensils"></i> Preparing
                    </span>
                </div>

                <div class="vendor-info">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=100" alt="Pizza Hut" class="vendor-logo">
                    <div>
                        <div class="vendor-name">Pizza Hut</div>
                        <div class="vendor-location">
                            <i class="fas fa-map-marker-alt"></i> DHA Phase 5, Karachi
                        </div>
                    </div>
                </div>

                <div class="order-items">
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=100" alt="Pizza" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Pepperoni Pizza (Large)</div>
                            <div class="item-qty">Qty: 1</div>
                        </div>
                        <div class="item-price">Rs. 1,200</div>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="order-total-label">Total:</span>
                        <span class="order-total-amount">Rs. 1,350</span>
                    </div>
                    <div class="order-actions">
                        <button class="btn-order btn-primary" onclick="trackOrder('12344')">
                            <i class="fas fa-map-marked-alt"></i> Track Order
                        </button>
                        <button class="btn-order btn-outline" onclick="cancelOrder('12344')">
                            <i class="fas fa-times-circle"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delivered Order 1 -->
            <div class="order-card" data-status="delivered">
                <div class="order-header">
                    <div class="order-info">
                        <div class="order-id">Order #12340</div>
                        <div class="order-date">
                            <i class="far fa-clock"></i> Yesterday, 8:45 PM
                        </div>
                    </div>
                    <span class="order-status status-delivered">
                        <i class="fas fa-check-circle"></i> Delivered
                    </span>
                </div>

                <div class="vendor-info">
                    <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=100" alt="Biryani House" class="vendor-logo">
                    <div>
                        <div class="vendor-name">Biryani House</div>
                        <div class="vendor-location">
                            <i class="fas fa-map-marker-alt"></i> Bahadurabad, Karachi
                        </div>
                    </div>
                </div>

                <div class="order-items">
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=100" alt="Biryani" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Chicken Biryani</div>
                            <div class="item-qty">Qty: 2</div>
                        </div>
                        <div class="item-price">Rs. 800</div>
                    </div>
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100" alt="Raita" class="item-image">
                        <div class="item-details">
                            <div class="item-name">Raita</div>
                            <div class="item-qty">Qty: 2</div>
                        </div>
                        <div class="item-price">Rs. 100</div>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="order-total-label">Total:</span>
                        <span class="order-total-amount">Rs. 1,020</span>
                    </div>
                    <div class="order-actions">
                        <button class="btn-order btn-secondary" onclick="reorder('12340')">
                            <i class="fas fa-redo"></i> Reorder
                        </button>
                        <button class="btn-order btn-outline" onclick="rateOrder('12340')">
                            <i class="fas fa-star"></i> Rate Order
                        </button>
                        <button class="btn-order btn-outline" onclick="viewDetails('12340')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cancelled Order -->
            <div class="order-card" data-status="cancelled">
                <div class="order-header">
                    <div class="order-info">
                        <div class="order-id">Order #12330</div>
                        <div class="order-date">
                            <i class="far fa-clock"></i> Dec 10, 2024, 3:20 PM
                        </div>
                    </div>
                    <span class="order-status status-cancelled">
                        <i class="fas fa-times-circle"></i> Cancelled
                    </span>
                </div>

                <div class="vendor-info">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100" alt="Sushi Bar" class="vendor-logo">
                    <div>
                        <div class="vendor-name">Sushi Bar</div>
                        <div class="vendor-location">
                            <i class="fas fa-map-marker-alt"></i> Zamzama, Karachi
                        </div>
                    </div>
                </div>

                <div class="order-items">
                    <div class="order-item">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100" alt="Sushi" class="item-image">
                        <div class="item-details">
                            <div class="item-name">California Roll</div>
                            <div class="item-qty">Qty: 1</div>
                        </div>
                        <div class="item-price">Rs. 850</div>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="order-total-label">Refund:</span>
                        <span class="order-total-amount" style="color: #48C774;">Rs. 950</span>
                    </div>
                    <div class="order-actions">
                        <button class="btn-order btn-secondary" onclick="reorder('12330')">
                            <i class="fas fa-redo"></i> Order Again
                        </button>
                        <button class="btn-order btn-outline" onclick="viewDetails('12330')">
                            <i class="fas fa-eye"></i> Details
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
    function filterOrders(status) {
        // Update active tab
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');

        // Filter orders
        const orders = document.querySelectorAll('.order-card');
        orders.forEach(order => {
            if (status === 'all') {
                order.style.display = 'block';
            } else {
                const orderStatus = order.getAttribute('data-status');
                order.style.display = orderStatus === status ? 'block' : 'none';
            }
        });

        console.log('Filtering orders by:', status);
    }

    function trackOrder(orderId) {
        window.location.href = `{{ url('/order-tracking') }}/${orderId}`;
    }

    function viewDetails(orderId) {
        console.log('Viewing details for order:', orderId);
        // Open order details modal or page
    }

    function reorder(orderId) {
        if (confirm('Add all items from this order to your cart?')) {
            console.log('Reordering:', orderId);
            alert('Items added to cart!');
            // Add reorder logic here
        }
    }

    function rateOrder(orderId) {
        console.log('Rating order:', orderId);
        // Open rating modal
        alert('Opening rating modal...');
    }

    function cancelOrder(orderId) {
        if (confirm('Are you sure you want to cancel this order? Cancellation charges may apply.')) {
            console.log('Cancelling order:', orderId);
            alert('Order cancellation request submitted');
            // Add cancellation logic here
        }
    }
</script>
@endsection