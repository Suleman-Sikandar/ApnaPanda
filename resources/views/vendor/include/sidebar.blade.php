<aside class="admin-sidebar" id="adminSidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <h4>🐼 ApnaPanda</h4>
        <small class="d-block text-muted mt-1 sidebar-subtitle">Vendor Panel</small>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="nav-section-title">Main Menu</span>
            <a href="{{ url('vendor/home') }}" class="nav-item {{ request()->routeIs('vendor.home') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ url('vendor/products') }}" class="nav-item {{ request()->routeIs('vendor.product') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>
            <a href="{{ url('vendor/orders') }}" class="nav-item {{ request()->routeIs('vendor.orders') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Orders</span>
            </a>
            <a href="{{ url('vendor/order-items') }}" class="nav-item {{ request()->routeIs('vendor.order-items') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Order Items</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Business</span>
            <a href="#" class="nav-item">
                <i class="bi bi-percent"></i>
                <span>Promotions</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-star"></i>
                <span>Reviews</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-graph-up"></i>
                <span>Analytics</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Financial</span>
            <a href="#" class="nav-item">
                <i class="bi bi-wallet2"></i>
                <span>Wallet</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-cash-coin"></i>
                <span>Earnings</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-file-earmark-text"></i>
                <span>Invoices</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Support</span>
            <a href="#" class="nav-item">
                <i class="bi bi-chat-dots"></i>
                <span>Messages</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-headset"></i>
                <span>Support</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </div>
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');

                // For mobile, use 'active' class instead
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('active');
                }
            });
        }
    });
</script>