@extends('admin.layouts.master')

@section('title', 'Admin Profile | ApnaPanda')

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
                    <h2 class="role-page-title">Admin Profile</h2>
                    <p class="role-page-subtitle">
                        View admin user details.
                    </p>
                </div>
            </div>
            <div class="role-header-actions">
                <a href="{{ route('admin.user') }}" class="role-btn-primary-gradient">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="role-table-card" style="padding: 20px;">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200" alt="Profile Image" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
@endpush
