<!-- Drawer Overlay -->
<div class="drawer-overlay" id="EditdrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="EditdrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Edit Admin</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editAdminForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="drawer-form-group">
                    <label for="name">Admin Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_admin_name" placeholder="Enter role name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="edit_admin_email" placeholder="Enter email">
                    <span class="form-error text-danger" id="error-email"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="phone" name="phone" id="edit_admin_phone" placeholder="Enter Phone">
                    <span class="form-error text-danger" id="error-phone"></span>
                </div>

                {{-- <div class="drawer-form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                    <span class="form-error text-danger" id="error-password"></span>
                </div> --}}

                <div class="drawer-form-group">
                    <label for="profile_image">Profile Photo</label>
                    <input type="file" name="profile_image" id="edit_admin_profile_image" placeholder="Enter profile_image">
                    <span class="form-error text-danger" id="error-profile_image"></span>
                    <div class="mt-2">
                        <img id="edit_profile_image_preview" src="#" alt="Image Preview" style="display: none; width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </div>
                </div>

                <div class="drawer-form-group">
                    <label for="role_id">Assign Role</label>
                    <select name="role_id" id="edit_admin_role" class="select2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-role_id"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editAdminForm">Save</button>
        </div>


    </div>
</div>
