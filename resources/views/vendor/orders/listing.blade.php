@extends('vendor.master')

@section('title', 'Order Management | ApnaPanda')
@section('header')
    @include('vendor.include.header')
@endsection
@section('sidebar')
    @include('vendor.include.sidebar')
@endsection
{{-- @section('toolbar')
    @include('vendor.includes.toolbar')
@endsection --}}
@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Order Management</h4>
                    <p class="text-muted mb-0">Track and manage all your orders</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-download me-2"></i>Export Orders
                    </button>
                    <button class="btn btn-primary-custom">
                        <i class="bi bi-printer me-2"></i>Print Orders
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
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
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stats-value">28</div>
                <div class="stats-label">Pending Orders</div>
                <div class="stats-change">
                    <i class="bi bi-dash"></i> No change
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stats-value">108</div>
                <div class="stats-label">Completed Orders</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 18% increase
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stats-value">PKR 285K</div>
                <div class="stats-label">Total Revenue</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 24% increase
                </div>
            </div>
        </div>
    </div>

    <!-- Order Listing Table -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">All Orders</h5>
                </div>
                
                <!-- Search and Filter Section -->
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search by Order ID, Customer name..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="paymentFilter">
                                <option value="">Payment Status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="dateFilter" placeholder="Filter by date">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100" id="resetFilters">
                                <i class="bi bi-arrow-clockwise me-1"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2451</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">AK</div>
                                        <div>
                                            <div class="fw-semibold">Ali Khan</div>
                                            <small class="text-muted">ali.khan@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">3 items</span>
                                </td>
                                <td>
                                    <strong>PKR 1,850</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle me-1"></i>Paid
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge online">Completed</span>
                                </td>
                                <td>
                                    <div>Nov 17, 2025</div>
                                    <small class="text-muted">02:30 PM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2450</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">SA</div>
                                        <div>
                                            <div class="fw-semibold">Sara Ahmed</div>
                                            <small class="text-muted">sara.ahmed@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">2 items</span>
                                </td>
                                <td>
                                    <strong>PKR 950</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle me-1"></i>Paid
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge busy">Processing</span>
                                </td>
                                <td>
                                    <div>Nov 17, 2025</div>
                                    <small class="text-muted">01:15 PM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2449</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">HR</div>
                                        <div>
                                            <div class="fw-semibold">Hassan Raza</div>
                                            <small class="text-muted">hassan.raza@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">5 items</span>
                                </td>
                                <td>
                                    <strong>PKR 2,340</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle me-1"></i>Paid
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge online">Completed</span>
                                </td>
                                <td>
                                    <div>Nov 16, 2025</div>
                                    <small class="text-muted">11:45 AM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2448</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">FN</div>
                                        <div>
                                            <div class="fw-semibold">Fatima Noor</div>
                                            <small class="text-muted">fatima.noor@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">1 item</span>
                                </td>
                                <td>
                                    <strong>PKR 4,500</strong>
                                </td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge pending">Pending</span>
                                </td>
                                <td>
                                    <div>Nov 16, 2025</div>
                                    <small class="text-muted">09:20 AM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2447</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">UA</div>
                                        <div>
                                            <div class="fw-semibold">Usman Ali</div>
                                            <small class="text-muted">usman.ali@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">4 items</span>
                                </td>
                                <td>
                                    <strong>PKR 3,200</strong>
                                </td>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger">
                                        <i class="bi bi-x-circle me-1"></i>Failed
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge offline">Cancelled</span>
                                </td>
                                <td>
                                    <div>Nov 15, 2025</div>
                                    <small class="text-muted">03:50 PM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <strong class="text-primary">#ORD-2446</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">ZH</div>
                                        <div>
                                            <div class="fw-semibold">Zara Hussain</div>
                                            <small class="text-muted">zara.hussain@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">6 items</span>
                                </td>
                                <td>
                                    <strong>PKR 5,670</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle me-1"></i>Paid
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge online">Completed</span>
                                </td>
                                <td>
                                    <div>Nov 15, 2025</div>
                                    <small class="text-muted">12:30 PM</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Invoice">
                                            <i class="bi bi-file-text"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-body border-top">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="mb-0 text-muted">Showing 1 to 6 of 152 entries</p>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">26</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-primary-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    color: white;
}

.stats-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.stats-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 15px;
}

.stats-value {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 5px;
}

.stats-label {
    color: #6B7280;
    font-size: 14px;
    font-weight: 500;
}

.stats-change {
    font-size: 13px;
    color: #6B7280;
    margin-top: 8px;
}

.stats-change.positive {
    color: #065F46;
}

.stats-change i {
    font-size: 12px;
}

.content-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    overflow: hidden;
}

.content-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.content-card-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.online {
    background: #D1FAE5;
    color: #065F46;
}

.status-badge.busy {
    background: #FEF3C7;
    color: #92400E;
}

.status-badge.pending {
    background: #DBEAFE;
    color: #1E40AF;
}

.status-badge.offline {
    background: #FEE2E2;
    color: #991B1B;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.table thead th {
    font-weight: 600;
    color: #374151;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e5e7eb;
    padding: 12px 16px;
}

.table tbody td {
    padding: 16px;
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
}

.table tbody tr:hover {
    background-color: #f9fafb;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}

.input-group-text {
    border: 1px solid #ced4da;
}

.pagination .page-link {
    color: #667eea;
    border: 1px solid #e5e7eb;
    padding: 8px 12px;
    margin: 0 2px;
    border-radius: 6px;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All Checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }
    
    // Reset Filters
    const resetButton = document.getElementById('resetFilters');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('paymentFilter').value = '';
            document.getElementById('dateFilter').value = '';
        });
    }
    
    // Search functionality (add your AJAX call here)
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            // Add your search logic here
            console.log('Searching for:', this.value);
        });
    }
    
    // Status filter change
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            // Add your filter logic here
            console.log('Filter by status:', this.value);
        });
    }
    
    // Payment filter change
    const paymentFilter = document.getElementById('paymentFilter');
    if (paymentFilter) {
        paymentFilter.addEventListener('change', function() {
            // Add your filter logic here
            console.log('Filter by payment:', this.value);
        });
    }
});
</script>
@endsection