@extends('admin.layouts.master')

@section('title', 'Order Logs | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- HEADER --}}
    <div class="role-header-card">
        <div class="role-header-left">
            <h2 class="role-page-title">Order Logs</h2>
            <p class="role-page-subtitle">History of order status changes.</p>
        </div>
        <div class="role-header-actions">
            {{-- No Add button for logs usually --}}
        </div>
    </div>

    {{-- LISTING --}}
    <div class="role-table-card">
        <div class="role-table-header">
            <h3 class="role-table-title">All Logs</h3>
            <div class="role-table-search">
                <div class="role-search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search logs..." id="logsSearchInput">
                </div>
            </div>
        </div>

        <table class="role-data-table data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Status Change</th>
                    <th>Changed By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>
                        <a href="#" class="text-primary fw-bold">#{{ $log->order_id }}</a>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $log->old_status ?? 'New' }}</span>
                        <i class="bi bi-arrow-right mx-2 text-muted"></i>
                        <span class="badge bg-primary">{{ $log->status_changed_to }}</span>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="fw-bold">{{ $log->user_type == 'admin' ? ($log->admin->name ?? 'Admin') : ($log->user->name ?? 'System') }}</span>
                            <small class="text-muted">{{ ucfirst($log->user_type) }}</small>
                        </div>
                    </td>
                    <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <div class="role-action-buttons">
                            @if(validatePermissions('admin/order-logs/delete/{id}'))
                                <button class="role-btn-icon role-btn-delete deleteLog" title="Delete" data-id="{{ $log->id }}">
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
<script>
    $(document).ready(function() {
        // DELETE LOG
        $('.deleteLog').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/order-logs/delete/' + id,
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function(response) {
                            if (response.status === true) {
                                Swal.fire('Deleted!', response.success, 'success').then(() => location.reload());
                            } else {
                                Swal.fire('Error!', 'Failed deleting.', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
