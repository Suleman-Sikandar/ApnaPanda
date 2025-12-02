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
                    <h2 class="role-page-title">Admin Roles</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>

            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="roleAdd">
                    <i class="bi bi-plus-circle"></i>Add New Role
                </button>
            </div>
        </div>

        <!-- Roles Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Roles</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search roles..." id="roleSearchInput">
                    </div>
                </div>
            </div>


            <div class="admin-roles-grid-container">
                @foreach ($roles as $role)
                    <div class="admin-role-card" id="{{ $role->id }}">
                        <span class="admin-role-status-badge admin-role-status-active">Active</span>

                        <div class="admin-role-card-header">
                            <h3 class="admin-role-card-title">{{ $role->name }}</h3>
                            <p class="admin-role-card-subtitle">Total modules assign to this role: 182</p>
                        </div>

                        <div class="admin-role-modules-section">
                            <span class="admin-role-modules-label">Modules:</span>
                            <ul class="admin-role-modules-list">
                                <li class="admin-role-module-item">Activity Types</li>
                                <li class="admin-role-module-item">Add Activity</li>
                                <li class="admin-role-module-item">Edit Activity</li>
                                <li class="admin-role-module-item">Update Activity Status</li>
                            </ul>
                        </div>

                        <div class="admin-role-card-footer">
                            <button class="admin-role-action-btn admin-role-btn-edit" data-id="{{ $role->id }}">
                                <i class="bi bi-pencil"></i> Edit Role
                            </button>
                            <button class="admin-role-action-btn admin-role-btn-delete destroyRoleBtn"
                                data-id="{{ $role->id }}">
                                <i class="bi bi-trash"></i> Delete Role
                            </button>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        @include('admin.role.add')
        <div id="editRoleContainer"></div>
        
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/role.js') }}"></script>
@endpush
