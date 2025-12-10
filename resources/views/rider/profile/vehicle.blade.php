<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Vehicle Details</h2>
        <p style="color: #6b7280; font-size: 14px;">Share your vehicle information.</p>
    </div>
    <form action="{{ route('rider.vehicle.store', $rider->id) }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Vehicle Type <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('vehicle_type') is-invalid @enderror"
                    name="vehicle_type" value="{{ old('vehicle_type', $rider->vehicle_type ?? '') }}" required>
                @error('vehicle_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Vehicle Number <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror"
                    name="vehicle_number" value="{{ old('vehicle_number', $rider->vehicle_number ?? '') }}" required>
                @error('vehicle_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">License Number <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('license_number') is-invalid @enderror"
                    name="license_number" value="{{ old('license_number', $rider->license_number ?? '') }}" required>
                @error('license_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">License Expiry</label>
                <input type="date" class="form-control @error('license_expiry') is-invalid @enderror"
                    name="license_expiry" value="{{ old('license_expiry', $rider->license_expiry ?? '') }}">
                @error('license_expiry') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">National ID Number</label>
                <input type="text" class="form-control @error('national_id_number') is-invalid @enderror"
                    name="national_id_number" value="{{ old('national_id_number', $rider->national_id_number ?? '') }}">
                @error('national_id_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-arrow-right"></i> Save & Next
        </button>
    </form>
</div>

