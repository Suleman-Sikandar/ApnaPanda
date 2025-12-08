@extends('admin.layouts.master')

@section('title', 'Business Management | ApnaPanda')

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
                    <h2 class="role-page-title">Business Management</h2>
                    <p class="role-page-subtitle">
                        Manage businesses.
                    </p>
                </div>
            </div>
            @if(validatePermissions('admin/business/store'))
            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="businessAdd">
                    <i class="bi bi-plus-circle"></i>Add New Business
                </button>
            </div>
            @endif
        </div>

        <!-- Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Businesses</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search..." id="searchInput">
                    </div>
                </div>
            </div>


            <table class="role-data-table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($businesses as $business)
                        <tr>
                            <td>{{ $business->id }}</td>
                            <td><strong>{{ $business->name }}</strong></td>
                            <td>
                                <span class="display_order">
                                    {{ $business->display_order ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="role-action-buttons">
                                @if(validatePermissions('admin/business/edit/{id}'))
                                    <button class="role-btn-icon role-btn-edit editBusiness" title="Edit Business"
                                        data-id="{{ $business->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @endif
                                @if(validatePermissions('admin/business/delete/{id}'))
                                    <button class="role-btn-icon role-btn-delete deleteBusiness"
                                        title="Delete Business" data-id="{{ $business->id }}">
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
        @include('admin.business.modals.add')
        @include('admin.business.modals.edit')
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/business.js') }}"></script>
@endpush
