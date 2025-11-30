@extends('admin.layouts.master')

@section('title', 'Admin Dashboard | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Page Header -->
        <!-- Header Card -->
        <div class="header-card">
            <div class="header-left">
                <div>
                    <h2 class="page-title">DashBoard</h2>
                    <p class="page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>

            <div class="header-actions">
                <button class="btn btn-outline-primary">
                    <i class="bi bi-download me-2"></i>Export Report
                </button>
                <button class="btn btn-primary-gradient">
                    <i class="bi bi-plus-circle me-2"></i>Add New
                </button>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stats-card">
                <div class="stats-icon" style="background: #DBEAFE; color: #1E40AF;">
                    <i class="bi bi-cart-check"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">1,245</div>
                    <div class="stats-label">Total Orders</div>
                    <div class="stats-change positive">
                        <i class="bi bi-arrow-up"></i> 12% from last month
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">PKR 2.5M</div>
                    <div class="stats-label">Total Revenue</div>
                    <div class="stats-change positive">
                        <i class="bi bi-arrow-up"></i> 18% increase
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">156</div>
                    <div class="stats-label">Active Vendors</div>
                    <div class="stats-change">
                        <i class="bi bi-dash"></i> No change
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">8,542</div>
                    <div class="stats-label">Total Customers</div>
                    <div class="stats-change positive">
                        <i class="bi bi-arrow-up"></i> 245 new users
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="charts-row">
            <div class="chart-card">
                <div class="card-header">
                    <h5 class="card-title">Revenue Overview</h5>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                        <option>Last year</option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="80"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="card-header">
                    <h5 class="card-title">Order Statistics</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Recent Orders</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Vendor</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>#ORD-5421</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Ali+Khan&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Ali Khan</span>
                                </div>
                            </td>
                            <td>ABC Electronics</td>
                            <td>3 items</td>
                            <td><strong>PKR 12,450</strong></td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>Nov 25, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-5420</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Sara+Ahmed&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Sara Ahmed</span>
                                </div>
                            </td>
                            <td>Fashion Hub</td>
                            <td>2 items</td>
                            <td><strong>PKR 5,200</strong></td>
                            <td><span class="badge bg-warning">Processing</span></td>
                            <td>Nov 25, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-5419</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Hassan+Raza&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Hassan Raza</span>
                                </div>
                            </td>
                            <td>Home Decor Plus</td>
                            <td>5 items</td>
                            <td><strong>PKR 18,900</strong></td>
                            <td><span class="badge bg-info">Shipped</span></td>
                            <td>Nov 24, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-5418</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Fatima+Ali&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Fatima Ali</span>
                                </div>
                            </td>
                            <td>Tech Store</td>
                            <td>1 item</td>
                            <td><strong>PKR 45,000</strong></td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>Nov 24, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-5417</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Ahmed+Shah&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Ahmed Shah</span>
                                </div>
                            </td>
                            <td>Sports World</td>
                            <td>4 items</td>
                            <td><strong>PKR 8,750</strong></td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td>Nov 23, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Revenue',
                            data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'PKR ' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Order Chart
            const orderCtx = document.getElementById('orderChart');
            if (orderCtx) {
                new Chart(orderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Completed', 'Processing', 'Shipped', 'Cancelled'],
                        datasets: [{
                            data: [450, 120, 80, 50],
                            backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#ef4444']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
    </script>

   
@endsection
