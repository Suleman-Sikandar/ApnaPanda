<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Security</h2>
        <p style="color: #6b7280; font-size: 14px;">Update your password.</p>
    </div>

    <form action="{{ url('rider/password/' . $rider->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-save"></i> Update Password
        </button>
    </form>
</div>

