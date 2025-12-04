@extends('admin.layouts.master')

@section('title', 'Reject Vendor | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- Header --}}
    <div class="role-header-card">
        <div class="role-header-left">
            <h2 class="role-page-title">Reject Vendor</h2>
            <p class="role-page-subtitle">Provide a reason for rejecting this vendor.</p>
        </div>
        <div class="role-header-actions">
            <a href="{{ route('admin.vendors') }}" class="role-btn-primary-gradient">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="role-table-card" style="padding: 25px; margin-top: 20px;">
        <form action="{{ url('admin/vendors/reject/'. $vendor->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="rejection_reason" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                <textarea name="rejection_reason" id="rejection_reason" rows="5" class="form-control" required placeholder="Enter reason for rejecting this vendor..."></textarea>
            </div>

            <button type="submit" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Submit Rejection
            </button>
        </form>
    </div>

</div>

@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection
