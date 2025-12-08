<header class="admin-header">
    <div class="header-left">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="header-right">
        <!-- Search Bar -->
        <div class="header-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search products, orders...">
        </div>

        <!-- Notifications -->
        <div class="header-item dropdown">
            <button class="header-btn" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge">5</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                <div class="dropdown-header">
                    <h6>Notifications</h6>
                    <span class="badge bg-primary">5 New</span>
                </div>
                <div class="notification-list">
                    <a href="#" class="notification-item unread">
                        <div class="notification-icon bg-primary">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-title">New Order Received</p>
                            <p class="notification-text">Order #12345 from John Doe</p>
                            <span class="notification-time">5 minutes ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-title">Product Approved</p>
                            <p class="notification-text">Your product has been approved</p>
                            <span class="notification-time">1 hour ago</span>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="#">View All Notifications</a>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="header-item">
            <button class="header-btn">
                <i class="bi bi-envelope"></i>
                <span class="badge">3</span>
            </button>
        </div>

        <!-- Profile -->
        <div class="header-item dropdown">
            <button class="header-profile" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Vendor&background=667eea&color=fff" alt="Vendor">
                <div class="profile-info">
                    <span class="profile-name">Vendor Name</span>
                    <span class="profile-role">Vendor</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"
                        style="border: none; background: none; width: 100%; text-align: left; cursor: pointer;">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
