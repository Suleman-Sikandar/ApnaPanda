<!-- Drawer Overlay -->
<div class="drawer-overlay" id="drawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="drawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Admin</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="addAdminForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="drawer-form-group">
                    <label for="name">Admin Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter role name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" placeholder="Enter email">
                    <span class="form-error text-danger" id="error-email"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="phone" name="phone" id="phone" placeholder="Enter Phone">
                    <span class="form-error text-danger" id="error-phone"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                    <span class="form-error text-danger" id="error-password"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="profile_image">Profile Photo</label>
                    <input type="file" name="profile_image" id="profile_image" placeholder="Enter profile_image">
                    <span class="form-error text-danger" id="error-profile_image"></span>
                    <div class="mt-2">
                        <img id="add_profile_image_preview" src="#" alt="Image Preview" style="display: none; width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </div>
                </div>

                <div class="drawer-form-group">
                    <label for="role_id">Assign Role</label>
                    <select name="role_ids[]" id="role_id" class="select2" multiple>
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
            <button type="button" class="btn-cancel" onclick="closeAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="addAdminForm">Save</button>
        </div>


    </div>
</div>
