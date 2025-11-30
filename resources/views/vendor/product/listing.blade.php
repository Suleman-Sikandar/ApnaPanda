@extends('vendor.master')

@section('title', 'Product Listing | ApnaPanda')
@section('header')
    @include('vendor.include.header')
@endsection
@section('sidebar')
    @include('vendor.include.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Product Management</h4>
                    <p class="text-muted mb-0">Manage your products and inventory</p>
                </div>
                <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-circle me-2"></i>Add New Product
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #DBEAFE; color: #1E40AF;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stats-value">348</div>
                <div class="stats-label">Total Products</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stats-value">312</div>
                <div class="stats-label">Active Products</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="stats-value">24</div>
                <div class="stats-label">Low Stock</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stats-value">12</div>
                <div class="stats-label">Out of Stock</div>
            </div>
        </div>
    </div>

    <!-- Product Listing Table -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">All Products</h5>
                </div>
                
                <!-- Search and Filter Section -->
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search products by name, SKU..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="electronics">Electronics</option>
                                <option value="fashion">Fashion</option>
                                <option value="food">Food & Beverages</option>
                                <option value="home">Home & Kitchen</option>
                                <option value="beauty">Beauty & Personal Care</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="stockFilter">
                                <option value="">All Stock</option>
                                <option value="instock">In Stock</option>
                                <option value="lowstock">Low Stock</option>
                                <option value="outofstock">Out of Stock</option>
                            </select>
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
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Rating</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">Wireless Bluetooth Headphones</div>
                                            <small class="text-muted">Premium Audio Quality</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">SKU-001</span></td>
                                <td>Electronics</td>
                                <td><strong>PKR 4,500</strong></td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">125 units</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <span>4.5</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">Cotton T-Shirt</div>
                                            <small class="text-muted">Available in multiple colors</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">SKU-002</span></td>
                                <td>Fashion</td>
                                <td><strong>PKR 850</strong></td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning">15 units</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <span>4.2</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">Organic Green Tea</div>
                                            <small class="text-muted">100g Pack</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">SKU-003</span></td>
                                <td>Food</td>
                                <td><strong>PKR 650</strong></td>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger">0 units</span>
                                </td>
                                <td>
                                    <span class="status-badge offline">Out of Stock</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <span>4.8</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">Smart Watch Series 5</div>
                                            <small class="text-muted">Fitness Tracking & More</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">SKU-004</span></td>
                                <td>Electronics</td>
                                <td><strong>PKR 12,500</strong></td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">45 units</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <span>4.7</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">Ceramic Coffee Mug Set</div>
                                            <small class="text-muted">Set of 4 Mugs</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">SKU-005</span></td>
                                <td>Home & Kitchen</td>
                                <td><strong>PKR 1,200</strong></td>
                                <td>
                                    <span class="badge bg-success-subtle text-success">88 units</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <span>4.3</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
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
                            <p class="mb-0 text-muted">Showing 1 to 5 of 348 entries</p>
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
                                    <li class="page-item"><a class="page-link" href="#">70</a></li>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productSKU" class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productSKU" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productCategory" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="productCategory" required>
                                <option value="">Select Category</option>
                                <option value="electronics">Electronics</option>
                                <option value="fashion">Fashion</option>
                                <option value="food">Food & Beverages</option>
                                <option value="home">Home & Kitchen</option>
                                <option value="beauty">Beauty & Personal Care</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="productPrice" class="form-label">Price (PKR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productPrice" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productStock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productStock" required>
                        </div>
                        <div class="col-md-12">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" accept="image/*">
                        </div>
                        <div class="col-md-12">
                            <label for="productStatus" class="form-label">Status</label>
                            <select class="form-select" id="productStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-custom">Add Product</button>
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

.status-badge.offline {
    background: #FEE2E2;
    color: #991B1B;
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
            document.getElementById('categoryFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('stockFilter').value = '';
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
});
</script>
@endsection