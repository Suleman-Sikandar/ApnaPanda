@extends('vendor.master')

@section('title', 'Vendor Dashboard | ApnaPanda')

@section('sidebar')
    @include('vendor.include.sidebar')
@endsection

@section('header')
    @include('vendor.include.header')
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Header Card -->
        <div class="header-card">
            <div class="header-left">
                <div>
                    <h2 class="page-title">Dashboard</h2>
                    <p class="page-subtitle">
                        Welcome back! Here's what's happening with your store today.
                    </p>
                </div>
            </div>

            <div class="header-actions">
                <button class="btn btn-outline-primary">
                    <i class="bi bi-download me-2"></i>Export Report
                </button>
                <button class="btn btn-primary-gradient" onclick="window.location.href='{{ route('vendor.product') }}'">
                    <i class="bi bi-plus-circle me-2"></i>Add Product
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
                    <div class="stats-value">{{ $orders }}</div>
                    <div class="stats-label">Total Orders</div>
                    <div class="stats-change">
                        <i class="bi bi-calendar"></i> All time
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">{{ $total }}</div>
                    <div class="stats-label">Total Revenue</div>
                    <div class="stats-change">
                        <i class="bi bi-cash"></i> Total earnings
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">{{ $products }}</div>
                    <div class="stats-label">Total Products</div>
                    <div class="stats-change">
                        <i class="bi bi-box"></i> Active products
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">{{ $rating }}</div>
                    <div class="stats-label">Average Rating</div>
                    <div class="stats-change positive">
                        <i class="bi bi-star"></i> Out of 5.0
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
                <a href="{{ route('vendor.orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>#ORD-2451</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Ali+Khan&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Ali Khan</span>
                                </div>
                            </td>
                            <td>3 items</td>
                            <td><strong>PKR 1,850</strong></td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>Nov 17, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-2450</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Sara+Ahmed&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Sara Ahmed</span>
                                </div>
                            </td>
                            <td>2 items</td>
                            <td><strong>PKR 950</strong></td>
                            <td><span class="badge bg-warning">Processing</span></td>
                            <td>Nov 17, 2025</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#ORD-2449</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Hassan+Raza&size=32" class="rounded-circle"
                                        width="32" height="32">
                                    <span>Hassan Raza</span>
                                </div>
                            </td>
                            <td>5 items</td>
                            <td><strong>PKR 2,340</strong></td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>Nov 16, 2025</td>
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

@push('scripts')
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
                            data: [3000, 4500, 3500, 6000, 5200, 7500, 6800],
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
                            data: [95, 28, 20, 9],
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
@endpush
