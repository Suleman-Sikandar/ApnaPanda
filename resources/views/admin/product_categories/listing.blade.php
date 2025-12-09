@extends('admin.layouts.master')

@section('title', 'Product Categories | ApnaPanda')

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
                    <h2 class="role-page-title">Product Categories</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>
            @if(validatePermissions('admin/product-categories/store'))
            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="productCatAdd">
                    <i class="bi bi-plus-circle"></i>Add New Category
                </button>
            </div>
            @endif
        </div>

        <!-- Product Categories Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Product Categories</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search categories..." id="productCatSearchInput">
                    </div>
                </div>
            </div>

            <table class="role-data-table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Icon Class</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td><strong>{{ $cat->category_name }}</strong></td>
                            <td>{{ $cat->icon_class ?? 'N/A' }}</td>
                            <td>{{ $cat->created_at->format('y-m-d') }}</td>
                            <td>
                                <div class="role-action-buttons">
                                    @if(validatePermissions('admin/product-categories/edit/{id}'))
                                    <button class="role-btn-icon role-btn-edit editProductCategory" title="Edit Category"
                                        data-id="{{ $cat->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @endif
                                    @if(validatePermissions('admin/product-categories/delete/{id}'))
                                    <button class="role-btn-icon role-btn-delete deleteProductCategory"
                                        title="Delete Category" data-id="{{ $cat->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('admin.product_categories.add')
        @include('admin.product_categories.edit')
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/product_category.js') }}"></script>
@endpush
