@extends('vendor.master')

@section('title', 'Products | ApnaPanda')

@section('sidebar')
    @include('vendor.include.sidebar')
@endsection

@section('header')
    @include('vendor.include.header')
@endsection

@section('content')
    <div class="role-dashboard-container">
        <div class="role-header-card">
            <div class="role-header-left">
                <div>
                    <h2 class="role-page-title">Products</h2>
                    <p class="role-page-subtitle">
                        Manage your product inventory
                    </p>
                </div>
            </div>

            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="productAdd">
                    <i class="bi bi-plus-circle"></i> Add New Product
                </button>
            </div>
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

                            <td>{{ $product->created_at->format('Y-m-d') }}</td>

                            <td>
                                <div class="role-action-buttons">
                                    <button class="role-btn-icon role-btn-edit editProduct" title="Edit Product"
                                        data-id="{{ $product->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="role-btn-icon role-btn-delete deleteProduct" title="Delete Product"
                                        data-id="{{ $product->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('vendor.product.modals.add')
        @include('vendor.product.modals.edit')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/js/product.js') }}"></script>
@endpush