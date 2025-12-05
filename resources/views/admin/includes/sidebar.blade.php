<aside class="admin-sidebar" id="adminSidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <h4>🐼 ApnaPanda</h4>
        <small class="d-block text-muted mt-1 sidebar-subtitle">Admin Panel</small>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="nav-section-title">Main</span>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-graph-up"></i>
                <span>Analytics</span>
            </a>
        </div>
        
        <div class="nav-section">
            <span class="nav-section-title">E-Commerce</span>
            {{-- <a href="#" class="nav-item">
                <i class="bi bi-cart"></i>
                <span>Orders</span>
                <span class="badge bg-primary">24</span>
            </a> --}}
            @if (validatePermissions('admin/product-categories'))
                <a href="{{ route('admin.product.categories') }}" class="nav-item {{ request()->routeIs('admin.product.categories') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i>
                <span>Product Categories</span>
            </a>
            @endif
            @if(validatePermissions('admin/products'))
           <a href="{{ route('admin.products') }}" class="nav-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>
            @endif
              {{--<a href="#" class="nav-item">
                <i class="bi bi-people"></i>
                <span>Customers</span>
            </a> --}}
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Vendors</span>
            @if(validatePermissions('admin/vendors'))
            <a href="{{ route('admin.vendors') }}" class="nav-item {{ request()->routeIs('admin.vendors') ? 'active' : '' }}">
                <i class="bi bi-shop"></i>
                <span>All Vendors</span>
            </a>
            @endif
            @if(validatePermissions('admin/vendors/pending-approval'))
            <a href="{{ route('admin.vendors.pending') }}" class="nav-item {{ request()->routeIs('admin.vendors.pending') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Pending Approval</span>
                {{-- <span class="badge bg-warning">5</span> --}}
            </a>
            @endif
            <a href="#" class="nav-item">
                <i class="bi bi-star"></i>
                <span>Top Vendors</span>
            </a>
        </div>

        {{-- <div class="nav-section">
            <span class="nav-section-title">Management</span>
            <a href="#" class="nav-item">
                <i class="bi bi-currency-dollar"></i>
                <span>Payments</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-chat-dots"></i>
                <span>Reviews</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-megaphone"></i>
                <span>Marketing</span>
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-ticket-perforated"></i>
                <span>Coupons</span>
            </a>
        </div> --}}

        <div class="nav-section">
            <span class="nav-section-title">Settings</span>
            <a href="#" class="nav-item">
                <i class="bi bi-gear"></i>
                <span>General Settings</span>
            </a>

            <!-- Admin Dropdown -->
            <div class="nav-item-dropdown">
                <a href="#"
                    class="nav-item {{ request()->routeIs('admin.role') || request()->routeIs('admin.user') ? 'active' : '' }}"
                    onclick="toggleDropdown(event, 'adminDropdown')">
                    <i class="bi bi-person-badge"></i>
                    <span>Admin</span>
                    <i class="bi bi-chevron-down dropdown-arrow"></i>
                </a>
                <div class="dropdown-submenu" id="adminDropdown">
                    @if (validatePermissions('admin/user'))
                        <a href="{{ route('admin.user') }}" class="nav-subitem">
                            <i class="bi bi-people"></i>
                            <span>Admin Users</span>
                        </a>
                    @endif
                    @if (validatePermissions('admin/roles'))
                        <a href="{{ route('admin.role') }}" class="nav-subitem">
                            <i class="bi bi-people"></i>
                            <span>Admin Roles</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Security Dropdown -->
            <div class="nav-item-dropdown">
                <a href="#"
                    class="nav-item {{ request()->routeIs('admin.modules') || request()->routeIs('admin.module.categories') ? 'active' : '' }}"
                    onclick="toggleDropdown(event, 'securityDropdown')">
                    <i class="bi bi-shield-check"></i>
                    <span>Security</span>
                    <i class="bi bi-chevron-down dropdown-arrow"></i>
                </a>
                <div class="dropdown-submenu" id="securityDropdown">
                    @if (validatePermissions('admin/modules'))
                        <a href="{{ route('admin.modules') }}" class="nav-subitem">
                            <i class="bi bi-grid-3x3"></i>
                            <span>Modules</span>
                        </a>
                    @endif
                    @if (validatePermissions('admin/module-categories'))
                        <a href="{{ route('admin.module.categories') }}" class="nav-subitem">
                            <i class="bi bi-folder"></i>
                            <span>Module Categories</span>
                        </a>
                    @endif
                </div>
            </div>

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

    // Toggle dropdown function
    function toggleDropdown(event, dropdownId) {
        event.preventDefault();
        event.stopPropagation();

        const dropdown = document.getElementById(dropdownId);
        const parentItem = event.currentTarget.parentElement;

        // Close all other dropdowns
        document.querySelectorAll('.dropdown-submenu').forEach(submenu => {
            if (submenu.id !== dropdownId) {
                submenu.classList.remove('show');
                submenu.parentElement.classList.remove('active');
            }
        });

        // Toggle current dropdown
        dropdown.classList.toggle('show');
        parentItem.classList.toggle('active');
    }
</script>
