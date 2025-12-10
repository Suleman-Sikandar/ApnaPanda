@extends('admin.layouts.master')

@section('title', 'Suspend Rider | ApnaPanda')

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
                <h2 class="role-page-title">Suspend Rider</h2>
                <p class="role-page-subtitle">Provide details for suspension.</p>
            </div>
        </div>

        <div class="role-table-card" style="padding: 25px;">
            <form action="{{ route('admin.riders.suspend', $rider->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Suspension Reason</label>
                    <textarea class="form-control" name="rejection_reason" rows="4" required>{{ old('rejection_reason') }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-slash-circle"></i> Suspend Rider
                </button>
                <a href="{{ route('admin.riders.show', $rider->id) }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

