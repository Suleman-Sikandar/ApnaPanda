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
                    <h2 class="role-page-title">Admin Users</h2>
                    <p class="role-page-subtitle">
                        Welcome back! Here's what's happening today.
                    </p>
                </div>
            </div>

            <div class="role-header-actions">
                <button class="role-btn-primary-gradient" id="addminAdd">
                    <i class="bi bi-plus-circle"></i>Add New Admin
                </button>
            </div>
        </div>

        <!-- Roles Table Card -->
        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">All Users</h3>
                <div class="role-table-search">
                    <div class="role-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search users..." id="roleSearchInput">
                    </div>
                </div>
            </div>

            <div class="role-table-responsive">
                <table class="role-data-table data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>User Role</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>profile Image</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="profile_image"
                                        width="70" height="70">
                                </td>

                                <td> {{ $user->created_at->format('y-m-d') }}</td>
                                <td>
                                    <div class="role-action-buttons">
                                        <button class="role-btn-icon role-btn-view" title="View Admin"
                                            onclick="window.location='{{ route('admin.user.show', $user->id) }}'">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <button class="role-btn-icon role-btn-edit editUser" title="Edit Admin"
                                            data-id="{{ $user->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="role-btn-icon role-btn-delete" title="Delete Admin"
                                            data-id="{{ $user->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @include('admin.user.add')
        @include('admin.user.edit')
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
@endpush
