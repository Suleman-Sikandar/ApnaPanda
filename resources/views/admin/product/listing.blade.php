@extends('admin.layouts.master')

@section('title', 'Products | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')
    <div class="role-dashboard-container">
        <div class="role-header-card">
            <div class="role-header-left">
                <div>
                    <h2 class="role-page-title">Products</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's your product overview.
                    </p>
                </div>
            </div>

            @if (validatePermissions('admin/products/store'))
                <div class="role-header-actions">
                    <button class="role-btn-primary-gradient" id="productAdd">
                        <i class="bi bi-plus-circle"></i>Add New Product
                    </button>
                </div>
            @endif
        </div>

        <!-- Products Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Products</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search products..." id="productSearchInput">
                    </div>
                </div>
            </div>

            <table class="role-data-table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Vendor</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>{{ $product->vendor->users->name ?? 'N/A' }}</td>
                            <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                            <td>PKR {{ number_format($product->price) }}</td>

                            <td>
                                @if ($product->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($product->status === 'out_of_stock')
                                    <span class="badge bg-warning text-dark">Out of Stock</span>
                                @elseif($product->status === 'pending_review')
                                    <span class="badge bg-info text-dark">Pending Review</span>
                                @elseif($product->status === 'banned')
                                    <span class="badge bg-danger">Banned</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>

                            <td>{{ $product->created_at->format('y-m-d') }}</td>

                            <td>
                                <div class="role-action-buttons">
                                    @if (validatePermissions('admin/products/edit/{id}'))
                                        <button class="role-btn-icon role-btn-edit editProduct" title="Edit Product"
                                            data-id="{{ $product->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    @endif

                                    @if (validatePermissions('admin/products/delete/{id}'))
                                        <button class="role-btn-icon role-btn-delete deleteProduct" title="Delete Product"
                                            data-id="{{ $product->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                     @if(validatePermissions('admin/products-detail/{id}'))
                                        <button class="role-btn-icon role-btn-view" title="View Admin"
                                            onclick="window.location='{{ route('admin.products.detail', $product->id) }}'">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('admin.product.add')
        @include('admin.product.edit')
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/product.js') }}"></script>
@endpush
