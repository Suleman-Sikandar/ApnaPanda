<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Documents</h2>
        <p style="color: #6b7280; font-size: 14px;">Upload your license and national ID.</p>
    </div>
    <form action="{{ route('rider.documents.store', $rider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">License Front</label>
                <input type="file" class="form-control @error('license_front') is-invalid @enderror"
                    name="license_front" accept="image/*">
                @error('license_front') <span class="text-danger">{{ $message }}</span> @enderror
                @if($rider->license_front)
                    <img src="{{ asset('storage/' . $rider->license_front) }}" style="max-width:140px; margin-top:10px;">
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">License Back</label>
                <input type="file" class="form-control @error('license_back') is-invalid @enderror"
                    name="license_back" accept="image/*">
                @error('license_back') <span class="text-danger">{{ $message }}</span> @enderror
                @if($rider->license_back)
                    <img src="{{ asset('storage/' . $rider->license_back) }}" style="max-width:140px; margin-top:10px;">
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">National ID Front</label>
                <input type="file" class="form-control @error('national_id_front') is-invalid @enderror"
                    name="national_id_front" accept="image/*">
                @error('national_id_front') <span class="text-danger">{{ $message }}</span> @enderror
                @if($rider->national_id_front)
                    <img src="{{ asset('storage/' . $rider->national_id_front) }}" style="max-width:140px; margin-top:10px;">
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">National ID Back</label>
                <input type="file" class="form-control @error('national_id_back') is-invalid @enderror"
                    name="national_id_back" accept="image/*">
                @error('national_id_back') <span class="text-danger">{{ $message }}</span> @enderror
                @if($rider->national_id_back)
                    <img src="{{ asset('storage/' . $rider->national_id_back) }}" style="max-width:140px; margin-top:10px;">
                @endif
            </div>
        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-arrow-right"></i> Save & Next
        </button>
    </form>
</div>

