@extends('admin.layouts.master')

@section('title', 'Rider Profile | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

    <div class="role-dashboard-container">

        {{-- HEADER SECTION --}}
        <div class="role-header-card">
            <div class="role-header-left">
                <h2 class="role-page-title">Rider Profile</h2>
                <p class="role-page-subtitle">View rider details and verify documents.</p>
            </div>
            <div class="role-header-actions">
                <a href="{{ route('admin.riders') }}" class="role-btn-primary-gradient">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        {{-- BASIC PROFILE + STATUS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom: 20px;">
            <div class="row">

                {{-- Rider Profile Image --}}
                <div class="col-md-4 text-center">
                    @if ($rider->profile_photo)
                        <img src="{{ asset('storage/' . $rider->profile_photo) }}" class="img-fluid rounded"
                            style="width: 220px; height: 220px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/placeholders/shops.png') }}" alt="Placeholder" class="img-fluid rounded"
                            style="width: 220px; height: 220px; object-fit: cover;">
                    @endif

                    <h5 class="mt-3">{{ $rider->users->name ?? 'N/A' }}</h5>

                    <div class="mt-2">
                        <span class="badge bg-{{ $rider->is_face_verified ? 'success' : 'warning' }}">
                            {{ $rider->is_face_verified ? 'Face Verified' : 'Face Not Verified' }}
                        </span>
                    </div>
                </div>

                {{-- Rider Summary --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $rider->users->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $rider->users->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $rider->phone ?? $rider->users->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Alternative Phone</th>
                            <td>{{ $rider->alternative_phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Registered On</th>
                            <td>{{ $rider->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($rider->status) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- VEHICLE DETAILS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Vehicle Details</h4>
            <table class="table table-striped">
                <tr>
                    <th>Vehicle Type</th>
                    <td>{{ $rider->vehicle_type ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Vehicle Number</th>
                    <td>{{ $rider->vehicle_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>License Number</th>
                    <td>{{ $rider->license_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>License Expiry</th>
                    <td>{{ $rider->license_expiry ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        {{-- DOCUMENTS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Documents</h4>
            <div class="row">

                @php
                    $docs = [
                        'License Front' => $rider->license_front,
                        'License Back' => $rider->license_back,
                        'National ID Front' => $rider->national_id_front,
                        'National ID Back' => $rider->national_id_back,
                    ];
                @endphp

                @foreach ($docs as $label => $file)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h6>{{ $label }}</h6>

                                @if ($file)
                                    <img src="{{ asset('storage/' . $file) }}" class="img-fluid rounded mb-2"
                                        style="height: 140px; object-fit: cover;">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                @else
                                    <span class="text-muted">Not Uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- LOCATION DETAILS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Location</h4>
            <table class="table table-striped">
                <tr>
                    <th>Address</th>
                    <td>{{ $rider->address ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $rider->city ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Province</th>
                    <td>{{ $rider->province ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Postal Code</th>
                    <td>{{ $rider->postal_code ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $rider->country ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Latitude / Longitude</th>
                    <td>{{ $rider->latitude ?? 'N/A' }} , {{ $rider->longitude ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        {{-- ADMIN ACTION BUTTONS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Actions</h4>

            <div class="d-flex gap-3">

                {{-- Approve --}}
                @if ($rider->status != "approved")
                    <form action="{{ route('admin.riders.approve', $rider->id) }}" method="POST" class="form">
                        @csrf

                        @if (validatePermissions('admin/riders/approve/{id}'))
                            <button class="btn btn-success">
                                <i class="bi bi-check2-circle"></i> Approve Rider
                            </button>
                        @endif
                    </form>
                @endif

                {{-- Reject --}}
                @if (validatePermissions('admin/riders/reject/{id}'))
                    <button class="btn btn-danger" onclick="window.location='{{ url('admin/riders/reject', $rider->id) }}'">
                        <i class="bi bi-x-circle" ></i> Reject Rider
                    </button>
                @endif

                {{-- Suspend --}}
                @if (validatePermissions('admin/riders/suspend/{id}'))
                    <button class="btn btn-warning" onclick="window.location='{{ url('admin/riders/suspend', $rider->id)}}'">
                        <i class="bi bi-slash-circle"></i> Suspend Rider
                    </button>
                @endif

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

