 <!-- Top Navigation -->
        <div class="top-nav">
            <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-info">
                <div class="status-toggle">
                    <span>Status:</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="statusSwitch" checked>
                    </div>
                    <span class="status-badge online" id="statusBadge">Online</span>
                </div>
                
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>