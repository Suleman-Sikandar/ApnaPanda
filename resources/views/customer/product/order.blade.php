@extends('customer.master')

@section('title', 'My Orders | ApnaPanda')
@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection

@section('styles')
    <style>
        /* ===================================
   MY ORDERS PAGE STYLES
   =================================== */

/* Main Container */
.orders-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 40px 0;
}

.orders-container .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Page Header */
.page-header {
    margin-bottom: 30px;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #FF6B35;
}

/* Stats Cards */
.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.stat-icon i {
    font-size: 28px;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    color: #7f8c8d;
    font-weight: 500;
}

/* Order Tabs */
.order-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.tab-btn {
    padding: 12px 24px;
    border: 2px solid #e0e0e0;
    background: white;
    color: #7f8c8d;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    border-color: #FF6B35;
    color: #FF6B35;
}

.tab-btn.active {
    background: #FF6B35;
    color: white;
    border-color: #FF6B35;
}

/* Order Cards */
#orders-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
}

/* Order Header */
.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    flex-wrap: wrap;
    gap: 15px;
}

.order-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.order-id {
    font-size: 18px;
    font-weight: 700;
}

.order-date {
    font-size: 13px;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 6px;
}

.order-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-transform: capitalize;
}

.status-pending {
    background: #FFF3CD;
    color: #856404;
}

.status-on-the-way {
    background: #D1ECF1;
    color: #0C5460;
}

.status-delivered {
    background: #D4EDDA;
    color: #155724;
}

.status-cancelled {
    background: #F8D7DA;
    color: #721C24;
}

/* Vendor Shop Card */
.vendor-shop-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 25px;
    border: none;
    border-bottom: 2px solid #f0f0f0;
    background: #fafafa;
    margin: 0;
    border-radius: 0;
    flex-wrap: wrap;
    gap: 15px;
}

.vendor-shop-card > div:first-child {
    display: flex;
    align-items: center;
    gap: 15px;
}

.vendor-logo {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.vendor-name {
    font-weight: 700;
    font-size: 16px;
    color: #2c3e50;
    margin-bottom: 4px;
}

.vendor-location {
    font-size: 13px;
    color: #7f8c8d;
    display: flex;
    align-items: center;
    gap: 6px;
}

.vendor-location i {
    color: #FF6B35;
}

.vendor-actions {
    display: flex;
    gap: 12px;
    align-items: center;
}

.vendor-actions a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.vendor-actions a:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.vendor-actions img {
    width: 24px;
    height: 24px;
    object-fit: contain;
}

/* Order Items */
.order-items {
    padding: 20px 25px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.2s ease;
}

.order-item:hover {
    background: #f0f1f3;
}

.item-image {
    width: 70px;
    height: 70px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid #e0e0e0;
}

.item-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.item-name {
    font-weight: 600;
    font-size: 15px;
    color: #2c3e50;
}

.item-qty {
    font-size: 13px;
    color: #7f8c8d;
}

.item-price {
    font-weight: 700;
    font-size: 16px;
    color: #FF6B35;
}

/* Order Footer */
.order-footer {
    padding: 20px 25px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 2px solid #e0e0e0;
    flex-wrap: wrap;
    gap: 15px;
}

.order-total {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.order-total-label {
    font-size: 13px;
    color: #7f8c8d;
    font-weight: 500;
}

.order-total-amount {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
}

.order-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Order Action Buttons */
.btn-order {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.btn-primary {
    background: #FF6B35;
    color: white;
}

.btn-primary:hover {
    background: #e55a2b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-secondary {
    background: #667eea;
    color: white;
}

.btn-secondary:hover {
    background: #5568d3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-outline {
    background: white;
    color: #7f8c8d;
    border: 2px solid #e0e0e0;
}

.btn-outline:hover {
    border-color: #FF6B35;
    color: #FF6B35;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .orders-container {
        padding: 20px 0;
    }

    .page-title {
        font-size: 24px;
    }

    .stats-cards {
        grid-template-columns: repeat(2, 1fr);
    }

    .order-header {
        padding: 15px 20px;
    }

    .order-id {
        font-size: 16px;
    }

    .vendor-shop-card {
        padding: 15px 20px;
    }

    .vendor-logo {
        width: 50px;
        height: 50px;
    }

    .order-items {
        padding: 15px 20px;
    }

    .order-footer {
        padding: 15px 20px;
        flex-direction: column;
        align-items: flex-start;
    }

    .order-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .btn-order {
        padding: 8px 16px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .stats-cards {
        grid-template-columns: 1fr;
    }

    .stat-card {
        padding: 20px;
    }

    .order-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .vendor-shop-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .vendor-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .order-item {
        gap: 10px;
    }

    .item-image {
        width: 60px;
        height: 60px;
    }

    .order-actions {
        flex-direction: column;
        width: 100%;
    }

    .btn-order {
        width: 100%;
        justify-content: center;
    }
}

/* Empty State */
.empty-orders {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

.empty-orders i {
    font-size: 80px;
    color: #e0e0e0;
    margin-bottom: 20px;
}

.empty-orders h3 {
    font-size: 24px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.empty-orders p {
    color: #7f8c8d;
    margin-bottom: 30px;
}

/* Loading Animation */
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
    </style>
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
                    <div class="stat-value">{{ $completedOrders }}</div>
                    <div class="stat-label">Completed Orders</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #FFF3E0;">
                        <i class="fas fa-clock" style="color: #FF9800;"></i>
                    </div>
                    <div class="stat-value">{{ $activeOrders }}</div>
                    <div class="stat-label">Active Orders</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #E3F2FD;">
                        <i class="fas fa-wallet" style="color: #2196F3;"></i>
                    </div>
                    <div class="stat-value">Rs. {{ number_format($totalSpent, 0) }}</div>
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

            {{-- <!-- Order Tabs -->
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
            </div> --}}
        </div>

        <!-- Order List -->
        <div id="orders-list">
            <!-- Active Order 1 -->
            @foreach($orders as $order)
            <div class="order-card" data-status="{{ $order->order_status }}">
                <div class="order-header">
                    <div class="order-info">
                        <div class="order-id">Order #{{ $order->id }}</div>
                        <div class="order-date">
                            <i class="far fa-clock"></i> {{ $order->created_at->format('M d, Y, h:i A') }}
                        </div>
                    </div>
                    <span class="order-status status-{{ Str::slug($order->order_status) }}">
                        <i class="fas fa-{{ $order->order_status == 'pending' ? 'clock' : ($order->order_status == 'on-the-way' ? 'motorcycle' : ($order->order_status == 'delivered' ? 'check-circle' : 'times-circle')) }}"></i> {{ ucfirst(str_replace('-', ' ', $order->order_status)) }}
                    </span>
                </div>

                {{-- Vendor Details Card --}}
                <div class="section-card" style="margin-bottom: 15px;">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-store text-danger"></i> Vendor Details</h3>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ asset('icon/man.jfif') }}" class="vendor-logo" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                            <div class="vendor-name" style="font-weight: bold;">{{ optional(optional(optional($order->orderItems->first())->product->vendor)->users)->name ?? 'N/A' }}</div>
                        </div>
                        <div class="vendor-actions" style="display: flex; gap: 10px;">
                            <a href="https://wa.me/{{ optional(optional($order->orderItems->first())->product->vendor)->phone }}" target="_blank" style="text-decoration: none; margin-right:50px;" title="Chat on WhatsApp">
                                <img src="{{ asset('icon/whatsapp.png') }}" alt="WhatsApp" style="width: 75px; height: 75px;">
                            </a>
                            <a href="#" style="text-decoration: none;" title="Chat on ApnaPanda">
                                <img src="{{ asset('icon/chat.png') }}" alt="ApnaPanda Chat" style="width: 50px; height: 50px;">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Delivery Address Card --}}
                <div class="section-card" style="margin-bottom: 15px;">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-map-marker-alt text-danger"></i> Delivery Address</h3>
                    </div>
                    <div style="padding: 10px 0; font-size: 0.9em; color: #555;">
                        {{ $order->delivery_address ?? 'N/A' }}
                    </div>
                </div>

              
                <div class="order-items">
                    @foreach($order->orderItems as $item)
                        <div class="order-item">
                            <img src="{{ optional(optional($item->product)->images->first())->image_path ? asset('storage/' . $item->product->images->first()->image_path) : asset('path/to/placeholder.png') }}" alt="{{ optional($item->product)->name ?? 'N/A' }}" class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ optional($item->product)->name ?? 'N/A' }}</div>
                                <div class="item-qty">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="item-price">Rs. {{ number_format($item->unit_price * $item->quantity, 0) }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="order-total-label">Total:</span>
                        <span class="order-total-amount">Rs. {{ number_format($order->payment_amount, 0) }}</span>
                    </div>
                    <div class="order-actions">
                        @if($order->order_status == 'pending' || $order->order_status == 'on-the-way')
                            <button class="btn-order btn-primary" onclick="trackOrder('{{ $order->id }}')">
                                <i class="fas fa-map-marked-alt"></i> Track Order
                            </button>
                            <button class="btn-order btn-outline" onclick="cancelOrder('{{ $order->id }}')">
                                <i class="fas fa-times-circle"></i> Cancel
                            </button>
                        @elseif($order->order_status == 'completed')
                            <button class="btn-order btn-secondary" onclick="reorder('{{ $order->id }}')">
                                <i class="fas fa-redo"></i> Reorder
                            </button>
                            <button class="btn-order btn-outline" onclick="rateOrder('{{ $order->id }}')">
                                <i class="fas fa-star"></i> Rate Order
                            </button>
                        @elseif($order->order_status == 'cancelled')
                            <button class="btn-order btn-secondary" onclick="reorder('{{ $order->id }}')">
                                <i class="fas fa-redo"></i> Order Again
                            </button>
                        @endif
                        <button class="btn-order btn-outline" onclick="viewDetails('{{ $order->id }}')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
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

