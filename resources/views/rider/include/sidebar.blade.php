 <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4 class="brand-text">
                <i class="fas fa-motorcycle"></i> ApnaPanda
            </h4>
        </div>
        <nav class="nav-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/dashboard') ? 'active' : '' }}" href="#">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/tasks*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-tasks"></i>
                        <span>Active Tasks</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/history*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-history"></i>
                        <span>History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/earnings*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-wallet"></i>
                        <span>Earnings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/profile*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rider/settings*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="#" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>