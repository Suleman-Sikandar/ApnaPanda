@extends('admin.layouts.master')

@section('title', 'Pending Riders | ApnaPanda')

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
                    <h2 class="role-page-title">Pending Rider Approvals</h2>
                    <p class="role-page-subtitle">
                        Review new rider applications awaiting approval.
                    </p>
                </div>
            </div>
        </div>

        <div class="role-table-card">
            <div class="role-table-header">
                <h3 class="role-table-title">Pending Riders</h3>
            </div>

            <table class="role-data-table data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($riders as $rider)
                        <tr>
                            <td>{{ $rider->id }}</td>
                            <td><strong>{{ $rider->users->name ?? 'N/A' }}</strong></td>
                            <td>{{ $rider->users->email ?? 'N/A' }}</td>
                            <td>{{ $rider->phone ?? $rider->users->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="info_here">{{ $rider->status }}</span>
                            </td>
                            <td>
                                <div class="role-action-buttons">
                                    @if(validatePermissions('admin/riders/profile/{id}'))
                                        <button class="role-btn-icon role-btn-view" title="View Rider"
                                            onclick="window.location='{{ route('admin.riders.show', $rider->id) }}'">
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
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

