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
                    <h2 class="role-page-title">All Vendors</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>
        @if(validatePermissions('admin/module-categories/store'))
            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="moduleCatAdd">
                    <i class="bi bi-plus-circle"></i>Add New vendor
                </button>
            </div>
        @endif
        </div>

        <!-- Roles Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Vendors</h3>
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
                        <th>Vendor ID</th>
                        <th>Business Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->id }}</td>
                            <td><strong>{{ $vendor->users->name ?? 'N/A' }}</strong></td>
                            <td>{{ $vendor->business_name ?? 'N/A' }}</td>
                            <td>{{ $vendor->users->email ?? 'N/A' }}</td>
                            <td>{{ $vendor->users->phone ?? 'N/A'}}</td>
                            <td>
                                @if($vendor->status == "approved")
                                <span class="is_active">{{ $vendor->status }}</span>
                               @endif
                               @if($vendor->status == "rejected")
                               <span class="is_inactive">{{ $vendor->status }}</span>
                               @endif
                               @if ($vendor->status == 'suspended')
                                   <span class="warning_here">{{ $vendor->status }}</span>
                               @endif
                               @if($vendor->status == 'pending')
                               <span class="info_here">{{ $vendor->status }}</span>
                               @endif
                            </td>
                            <td>
                                <div class="role-action-buttons">
                                     @if(validatePermissions('admin/vendors/profile/{id}'))
                                        <button class="role-btn-icon role-btn-view" title="View Admin"
                                            onclick="window.location='{{ route('admin.vendors.show', $vendor->id) }}'">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @endif
                                @if(validatePermissions('admin/module-categories/edit/{id}'))
                                    <button class="role-btn-icon role-btn-edit editModuleCategory" title="Edit Category"
                                        data-id="{{ $vendor->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @endif
                                @if(validatePermissions('admin/module-categories/delete/{id}'))
                                    <button class="role-btn-icon role-btn-delete deleteModuleCategory"
                                        title="Delete Category" data-id="{{ $vendor->id }}">
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
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/module_category.js') }}"></script>
@endpush
