@extends('vendor.master')

@section('title', 'Category Management | ApnaPanda')
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
                    <h4 class="mb-1">Category Management</h4>
                    <p class="text-muted mb-0">Organize and manage your product categories</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                        <i class="bi bi-file-earmark-excel me-2"></i>Import Excel
                    </button>
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#importXmlModal">
                        <i class="bi bi-file-earmark-code me-2"></i>Import XML
                    </button>
                    <button class="btn btn-outline-secondary" id="exportBtn">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                    <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Category
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
                    <i class="bi bi-grid-3x3-gap"></i>
                </div>
                <div class="stats-value">48</div>
                <div class="stats-label">Total Categories</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 8 new this month
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stats-value">42</div>
                <div class="stats-label">Active Categories</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 87.5% active
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FEF3C7; color: #92400E;">
                    <i class="bi bi-diagram-3"></i>
                </div>
                <div class="stats-value">12</div>
                <div class="stats-label">Parent Categories</div>
                <div class="stats-change">
                    <i class="bi bi-dash"></i> No change
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: #FCE7F3; color: #9F1239;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stats-value">324</div>
                <div class="stats-label">Total Products</div>
                <div class="stats-change positive">
                    <i class="bi bi-arrow-up"></i> 15% increase
                </div>
            </div>
        </div>
    </div>

    <!-- Category Listing Table -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">All Categories</h5>
                </div>
                
                <!-- Search and Filter Section -->
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search categories by name, slug..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="parentFilter">
                                <option value="">All Categories</option>
                                <option value="parent">Parent Only</option>
                                <option value="child">Sub Categories Only</option>
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
                                <th width="80">Image</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Electronics" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Electronics</div>
                                    <small class="text-muted">Main category for electronics</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">electronics</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Root</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">45 items</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">1</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Mobile Phones" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold ms-3">
                                        <i class="bi bi-arrow-return-right text-muted me-1"></i>Mobile Phones
                                    </div>
                                    <small class="text-muted ms-3 ps-3">Smartphones and accessories</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">mobile-phones</code>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info">Electronics</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">28 items</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">1</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Fashion" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Fashion & Apparel</div>
                                    <small class="text-muted">Clothing and accessories</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">fashion-apparel</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Root</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">67 items</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">2</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Home & Living" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Home & Living</div>
                                    <small class="text-muted">Furniture and home decor</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">home-living</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Root</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">32 items</span>
                                </td>
                                <td>
                                    <span class="status-badge offline">Inactive</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">3</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Sports" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Sports & Outdoors</div>
                                    <small class="text-muted">Sports equipment and gear</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">sports-outdoors</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Root</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">19 items</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">4</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                                    <div class="category-image-wrapper">
                                        <img src="https://via.placeholder.com/50" alt="Books" class="category-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Books & Media</div>
                                    <small class="text-muted">Books, magazines, and media</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">books-media</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Root</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">54 items</span>
                                </td>
                                <td>
                                    <span class="status-badge online">Active</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">5</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Products">
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
                            <p class="mb-0 text-muted">Showing 1 to 6 of 48 entries</p>
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
                                    <li class="page-item"><a class="page-link" href="#">8</a></li>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>Add New Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCategoryForm">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter category name" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" placeholder="auto-generated-slug">
                            <small class="text-muted">Leave empty to auto-generate from name</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Parent Category</label>
                            <select class="form-select">
                                <option value="">None (Root Category)</option>
                                <option value="1">Electronics</option>
                                <option value="2">Fashion & Apparel</option>
                                <option value="3">Home & Living</option>
                                <option value="4">Sports & Outdoors</option>
                                <option value="5">Books & Media</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter category description"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Category Image</label>
                            <input type="file" class="form-control" accept="image/*">
                            <small class="text-muted">Recommended size: 500x500px</small>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" class="form-control" value="0" min="0">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="showOnHomepage">
                                <label class="form-check-label" for="showOnHomepage">
                                    Show on homepage
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isFeatured">
                                <label class="form-check-label" for="isFeatured">
                                    Featured category
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Meta Title (SEO)</label>
                            <input type="text" class="form-control" placeholder="Enter meta title">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Meta Description (SEO)</label>
                            <textarea class="form-control" rows="2" placeholder="Enter meta description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-check-circle me-1"></i>Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import Excel Modal -->
<div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelModalLabel">
                    <i class="bi bi-file-earmark-excel me-2"></i>Import Categories from Excel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="importExcelForm">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Format Requirements:</strong> Excel file (.xlsx, .xls) with columns: Name, Slug, Parent, Description, Status, Order
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Select Excel File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="skipDuplicates" checked>
                            <label class="form-check-label" for="skipDuplicates">
                                Skip duplicate categories
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="updateExisting">
                            <label class="form-check-label" for="updateExisting">
                                Update existing categories
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-download me-1"></i>Download Sample Template
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i>Import Categories
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import XML Modal -->
<div class="modal fade" id="importXmlModal" tabindex="-1" aria-labelledby="importXmlModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importXmlModalLabel">
                    <i class="bi bi-file-earmark-code me-2"></i>Import Categories from XML
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="importXmlForm">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Format Requirements:</strong> Valid XML file with proper category structure
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Select XML File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" accept=".xml" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">XML Structure Type</label>
                        <select class="form-select">
                            <option value="standard">Standard Format</option>
                            <option value="woocommerce">WooCommerce Format</option>
                            <option value="magento">Magento Format</option>
                            <option value="custom">Custom Format</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="validateXml" checked>
                            <label class="form-check-label" for="validateXml">
                                Validate XML structure before import
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="createParents">
                            <label class="form-check-label" for="createParents">
                                Auto-create parent categories if missing
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-download me-1"></i>Download Sample XML Template
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">
                        <i class="bi bi-upload me-1"></i>Import Categories
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Export Dropdown Menu (Hidden, triggered by JS) -->
<div class="dropdown-menu" id="exportMenu">
    <a class="dropdown-item" href="#" data-format="excel">
        <i class="bi bi-file-earmark-excel me-2"></i>Export as Excel
    </a>
    <a class="dropdown-item" href="#" data-format="csv">
        <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export as CSV
    </a>
    <a class="dropdown-item" href="#" data-format="xml">
        <i class="bi bi-file-earmark-code me-2"></i>Export as XML
    </a>
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

/* Stats Cards */
.stats-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.stats-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 16px;
}

.stats-value {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.stats-label {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 8px;
}

.stats-change {
    font-size: 13px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.stats-change.positive {
    color: #10b981;
}

.stats-change i {
    font-size: 12px;
}

/* Content Card */
.content-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #f0f0f0;
}

.content-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f0f0f0;
    background: #fafafa;
}

.content-card-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

/* Category Image */
.category-image-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Status Badge */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.online {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.offline {
    background: #fee2e2;
    color: #991b1b;
}

/* Table Styling */
.table-hover tbody tr {
    transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
    background-color: #f9fafb;
}

.table thead th {
    font-weight: 600;
    color: #374151;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 16px 12px;
}

.table tbody td {
    padding: 16px 12px;
    vertical-align: middle;
}

/* Form Controls */
.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Modal Styling */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
    border-bottom: 1px solid #f0f0f0;
    padding: 20px 24px;
}

.modal-title {
    font-weight: 600;
    color: #1a1a1a;
}

.modal-body {
    padding: 24px;
}

.modal-footer {
    border-top: 1px solid #f0f0f0;
    padding: 16px 24px;
}

/* Pagination */
.pagination .page-link {
    border: 1px solid #e5e7eb;
    color: #374151;
    padding: 8px 12px;
    margin: 0 2px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-card {
        margin-bottom: 16px;
    }
    
    .table-responsive {
        font-size: 14px;
    }
}
</style>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All Checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('tbody .form-check-input');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }
    
    // Search Functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
    
    // Status Filter
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            filterTable();
        });
    }
    
    // Parent Filter
    const parentFilter = document.getElementById('parentFilter');
    if (parentFilter) {
        parentFilter.addEventListener('change', function() {
            filterTable();
        });
    }
    
    // Filter Table Function
    function filterTable() {
        const statusValue = statusFilter ? statusFilter.value : '';
        const parentValue = parentFilter ? parentFilter.value : '';
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            let showRow = true;
            
            // Status filter
            if (statusValue) {
                const statusBadge = row.querySelector('.status-badge');
                if (statusBadge) {
                    const isActive = statusBadge.classList.contains('online');
                    if (statusValue === 'active' && !isActive) showRow = false;
                    if (statusValue === 'inactive' && isActive) showRow = false;
                }
            }
            
            // Parent filter
            if (parentValue) {
                const parentBadge = row.querySelector('td:nth-child(5) .badge');
                if (parentBadge) {
                    const isRoot = parentBadge.textContent.trim() === 'Root';
                    if (parentValue === 'parent' && !isRoot) showRow = false;
                    if (parentValue === 'child' && isRoot) showRow = false;
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
    
    // Reset Filters
    const resetFiltersBtn = document.getElementById('resetFilters');
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (statusFilter) statusFilter.value = '';
            if (parentFilter) parentFilter.value = '';
            
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.style.display = '';
            });
        });
    }
    
    // Export Button
    const exportBtn = document.getElementById('exportBtn');
    const exportMenu = document.getElementById('exportMenu');
    
    if (exportBtn && exportMenu) {
        exportBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Position the menu below the button
            const rect = exportBtn.getBoundingClientRect();
            exportMenu.style.position = 'absolute';
            exportMenu.style.top = (rect.bottom + window.scrollY) + 'px';
            exportMenu.style.left = rect.left + 'px';
            exportMenu.classList.toggle('show');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!exportBtn.contains(e.target) && !exportMenu.contains(e.target)) {
                exportMenu.classList.remove('show');
            }
        });
        
        // Handle export format selection
        const exportLinks = exportMenu.querySelectorAll('.dropdown-item');
        exportLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const format = this.dataset.format;
                console.log('Exporting as:', format);
                
                // Here you would implement the actual export functionality
                alert('Exporting categories as ' + format.toUpperCase());
                exportMenu.classList.remove('show');
            });
        });
    }
    
    // Form Submissions
    const addCategoryForm = document.getElementById('addCategoryForm');
    if (addCategoryForm) {
        addCategoryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Adding new category...');
            
            // Here you would implement the actual form submission
            alert('Category added successfully!');
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
            if (modal) modal.hide();
            
            // Reset form
            this.reset();
        });
    }
    
    const importExcelForm = document.getElementById('importExcelForm');
    if (importExcelForm) {
        importExcelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Importing from Excel...');
            
            // Here you would implement the actual import functionality
            alert('Categories imported successfully from Excel!');
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('importExcelModal'));
            if (modal) modal.hide();
            
            // Reset form
            this.reset();
        });
    }
    
    const importXmlForm = document.getElementById('importXmlForm');
    if (importXmlForm) {
        importXmlForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Importing from XML...');
            
            // Here you would implement the actual import functionality
            alert('Categories imported successfully from XML!');
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('importXmlModal'));
            if (modal) modal.hide();
            
            // Reset form
            this.reset();
        });
    }
    
    // Auto-generate slug from category name
    const categoryNameInput = document.querySelector('#addCategoryForm input[type="text"]');
    const slugInput = document.querySelector('#addCategoryForm input[placeholder*="slug"]');
    
    if (categoryNameInput && slugInput) {
        categoryNameInput.addEventListener('input', function() {
            if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
            }
        });
        
        slugInput.addEventListener('input', function() {
            if (this.value) {
                this.dataset.autoGenerated = 'false';
            }
        });
    }
});
</script>
@endsection