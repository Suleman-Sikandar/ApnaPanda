<!-- Edit Drawer Overlay -->
<div class="drawer-overlay" id="EditdrawerModal">

    <!-- Edit Drawer -->
    <div class="drawer" id="EditdrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Edit Business</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editBusinessForm" method="POST">
                @csrf

                <!-- Name -->
                <div class="drawer-form-group">
                    <label for="edit_name">Business Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" placeholder="Enter business name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="edit_display_order">Display Order <span class="text-danger">*</span></label>
                    <input type="number" name="display_order" id="edit_display_order" placeholder="Enter display order" required>
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editBusinessForm">Update</button>
        </div>

    </div>
</div>
