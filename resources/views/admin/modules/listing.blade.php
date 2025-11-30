@extends('admin.layouts.master')

@section('title', 'Admin Modules | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')
<div class="role-dashboard-container">

    <!-- Header Card -->
    <div class="role-header-card">
        <div class="role-header-left">
            <div>
                <h2 class="role-page-title">Admin Modules</h2>
                <p class="role-page-subtitle">Welcome back! Here's what's happening today.</p>
            </div>
        </div>

        <div class="role-header-actions">
            <button class="role-btn-primary-gradient" id="moduleAdd">
                <i class="bi bi-plus-circle"></i> Add New Module
            </button>
        </div>
    </div>

    <!-- Modules Grid -->
    <div class="admin-roles-grid-container">
        @foreach ($modules as $mod)
        <div class="admin-role-card" id="module-{{ $mod->id }}">
            
            <span class="admin-role-status-badge {{ $mod->is_active ? 'admin-role-status-active' : 'admin-role-status-inactive' }}">
                {{ $mod->is_active ? 'Active' : 'Inactive' }}
            </span>

            <div class="admin-role-card-header">
                <h3 class="admin-role-card-title">{{ $mod->module_name }}</h3>
                <p class="admin-role-card-subtitle">
                    Category: {{ $mod->category?->name ?? '-' }} | Route: {{ $mod->route ?? '-' }}
                </p>
            </div>

            <div class="admin-role-modules-section">
                <span class="admin-role-modules-label">Module Details:</span>
                <ul class="admin-role-modules-list">
                    <li class="admin-role-module-item">Display Order: {{ $mod->display_order ?? '-' }}</li>
                    <li class="admin-role-module-item">Show in Menu: {{ $mod->show_in_menu ? 'Yes' : 'No' }}</li>
                    <li class="admin-role-module-item">Icon Class: {{ $mod->icon_class ?? '-' }}</li>
                </ul>
            </div>

            <div class="admin-role-card-footer">
                <button class="admin-role-action-btn admin-role-btn-edit editModule" title="Edit Module" data-id="{{ $mod->id }}">
                    <i class="bi bi-pencil"></i> Edit Module
                </button>
                <button class="admin-role-action-btn admin-role-btn-delete module-btn-delete" title="Delete Module" data-id="{{ $mod->id }}">
                    <i class="bi bi-trash"></i> Delete Module
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add/Edit Drawers -->
    @include('admin.modules.add')
    @include('admin.modules.edit')

</div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
<script src="{{ asset('admin/js/module.js') }}"></script>
@endpush
