@extends('admin.layouts.master')

@section('title', 'Admin Roles | ApnaPanda')

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
                    <h2 class="role-page-title">Module Categories</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>
        @if(validatePermissions('admin/module-categories/store'))
            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="moduleCatAdd">
                    <i class="bi bi-plus-circle"></i>Add New Category
                </button>
            </div>
        @endif
        </div>

        <!-- Roles Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Module Categories</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search roles..." id="roleSearchInput">
                    </div>
                </div>
            </div>


            <table class="role-data-table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Display Order</th>
                        <th>Is Active</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td><strong>{{ $cat->name }}</strong></td>
                            <td>
                                <span class="display_order">
                                    {{ $cat->display_order ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if ($cat->is_active)
                                    <span class="is_active">Active</span>
                                @else
                                    <span class="is_inactive">Inactive</span>
                                @endif
                            </td>
                            <td> {{ $cat->created_at->format('y-m-d') }}</td>
                            <td>
                                <div class="role-action-buttons">
                                @if(validatePermissions('admin/module-categories/edit/{id}'))
                                    <button class="role-btn-icon role-btn-edit editModuleCategory" title="Edit Category"
                                        data-id="{{ $cat->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @endif
                                @if(validatePermissions('admin/module-categories/delete/{id}'))
                                    <button class="role-btn-icon role-btn-delete deleteModuleCategory"
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
        @include('admin.module_categories.add')
        @include('admin.module_categories.edit')
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/module_category.js') }}"></script>
@endpush
