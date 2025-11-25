@extends('vendor.master')

@section('title', 'Vendor Dashboard | ApnaPanda')
@section('header')
    @include('vendor.include.header')
@endsection
@section('sidebar')
    @include('vendor.include.sidebar')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #DBEAFE; color: #1E40AF;">
                    <i class="bi bi-cart-check"></i>
                </div>
                <div class="stats-value">152</div>
                <div class="stats-label">Total Orders</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 12% from last month
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stats-value">PKR 85,450</div>
                <div class="stats-label">Today's Revenue</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 8% increase
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stats-value">348</div>
                <div class="stats-label">Total Products</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 5 new added
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div class="stats-value">4.8</div>
                <div class="stats-label">Average Rating</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 0.2 points
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">Recent Orders</h5>
                    <button class="btn btn-primary-custom btn-sm">View All</button>
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
                                <td>#ORD-2451</td>
                                <td>Ali Khan</td>
                                <td>3 items</td>
                                <td>PKR 1,850</td>
                                <td><span class="status-badge online">Completed</span></td>
                                <td>Nov 17, 2025</td>
                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                            </tr>
                            <tr>
                                <td>#ORD-2450</td>
                                <td>Sara Ahmed</td>
                                <td>2 items</td>
                                <td>PKR 950</td>
                                <td><span class="status-badge busy">Processing</span></td>
                                <td>Nov 17, 2025</td>
                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                            </tr>
                            <tr>
                                <td>#ORD-2449</td>
                                <td>Hassan Raza</td>
                                <td>5 items</td>
                                <td>PKR 2,340</td>
                                <td><span class="status-badge online">Completed</span></td>
                                <td>Nov 16, 2025</td>
                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection