<!-- Edit Drawer Overlay -->
<div class="drawer-overlay" id="EditdrawerModal">

    <!-- Edit Drawer -->
    <div class="drawer" id="EditdrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Edit Module Category</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editModuleCategoryForm" method="POST">
                @csrf

                <!-- Category Name -->
                <div class="drawer-form-group">
                    <label for="edit_category_name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_category_name" placeholder="Enter category name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="edit_display_order">Display Order</label>
                    <input type="number" name="display_order" id="edit_display_order" placeholder="Enter display order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

                <!-- Is Active -->
                <div class="drawer-form-group">
                    <label for="edit_is_active">
                        <input type="hidden" name="is_active" value="0"> <!-- ensures 0 when unchecked -->
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1">
                        Active
                    </label>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editModuleCategoryForm">Update</button>
        </div>

    </div>
</div>
