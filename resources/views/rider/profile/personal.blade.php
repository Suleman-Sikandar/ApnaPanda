<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Personal Information</h2>
        <p style="color: #6b7280; font-size: 14px;">Update your personal details to start riding.</p>
    </div>
    <form id="rider-profile-form" action="{{ url('rider/profile/' . $rider->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-grid">

            <div class="form-group">
                <label class="form-label">Full Name <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name', $rider->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address <span style="color:red;">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email', $rider->email) }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number <span style="color:red;">*</span></label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ old('phone', $rider->phone ?? '') }}" required>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Alternative Phone</label>
                <input type="tel" class="form-control @error('alternative_phone') is-invalid @enderror"
                    name="alternative_phone" value="{{ old('alternative_phone', $rider->alternative_phone ?? '') }}">
                @error('alternative_phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                    name="date_of_birth"
                    value="{{ old('date_of_birth', $rider->date_of_birth ? \Carbon\Carbon::parse($rider->date_of_birth)->format('Y-m-d') : '') }}">
                @error('date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $rider->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $rider->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $rider->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">Profile Image</label>
                <input type="file" id="riderProfileImageInput" name="profile_image" accept="image/*"
                    style="display:none;">
                <button type="button" id="riderOpenImagePicker" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Image
                </button>
                @error('profile_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div id="riderCropContainer" style="display:none; margin-top: 15px;">
                    <h5>Adjust Your Image</h5>
                    <img id="riderCropperImage" style="max-width:100%; border-radius:10px;">
                    <div style="margin-top:10px;">
                        <button type="button" id="riderCropImageBtn" class="btn btn-success">
                            <i class="fas fa-check"></i> Save
                        </button>
                        <button type="button" id="riderCancelCropBtn" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <img id="riderProfilePreviewForm" src="{{ $rider->profile_image ? asset('storage/' . $rider->profile_image) : '' }}"
                        style="display: {{ $rider->profile_image ? 'block' : 'none' }}; max-width: 150px; border-radius: 10px;">
                </div>
            </div>

        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-arrow-right"></i> Save & Next
        </button>
    </form>
</div>

@push('scripts')
<script>
    let riderCropper;

    document.getElementById('riderOpenImagePicker').addEventListener('click', function() {
        document.getElementById('riderProfileImageInput').click();
    });

    document.getElementById('riderProfileImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('riderCropperImage').src = e.target.result;
            document.getElementById('riderCropContainer').style.display = 'block';

            if (riderCropper) riderCropper.destroy();

            riderCropper = new Cropper(document.getElementById('riderCropperImage'), {
                aspectRatio: 1,
                viewMode: 2,
                autoCropArea: 1
            });
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('riderCancelCropBtn').onclick = function() {
        document.getElementById('riderCropContainer').style.display = 'none';
        if (riderCropper) riderCropper.destroy();
    };

    document.getElementById('riderCropImageBtn').onclick = function() {
        const canvas = riderCropper.getCroppedCanvas({
            width: 300,
            height: 300
        });

        const croppedImg = canvas.toDataURL('image/png');

        document.getElementById('riderProfilePreviewForm').src = croppedImg;
        document.getElementById('riderProfilePreviewForm').style.display = 'block';
        document.getElementById('profileSidebarAvatar').style.backgroundImage = `url(${croppedImg})`;

        const imgInput = document.createElement("input");
        imgInput.type = "hidden";
        imgInput.name = "croppedImage";
        imgInput.value = croppedImg;
        document.querySelector("#rider-profile-form").appendChild(imgInput);

        document.getElementById('riderCropContainer').style.display = 'none';

        riderCropper.destroy();
    };
</script>
@endpush

