<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Security Settings</h2>
        <p style="color: #6b7280; font-size: 14px;">Keep your account secure</p>
    </div>
    <form action="{{ url('vendor/password/' . $vendor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">

            <!-- Current Password -->
            <div class="form-group">
                <label class="form-label">Current Password <span style="color:red;">*</span></label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                    name="current_password" required>
                @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div></div>

            <!-- New Password -->
            <div class="form-group">
                <label class="form-label">New Password <span style="color:red;">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label class="form-label">Confirm New Password <span style="color:red;">*</span></label>
                <input type="password" class="form-control"
                    name="password_confirmation" required>
            </div>

        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-lock"></i> Change Password
        </button>
    </form>
</div>
