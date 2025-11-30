<!-- Drawer Overlay -->
<div class="drawer-overlay" id="drawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="drawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Module Category</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="categoriesForm" method="POST" action="">
                @csrf

                <!-- Role Name -->
                <div class="drawer-form-group">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter Category name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" name="display_order" id="display_order" placeholder="Enter display order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

                <!-- Is Active -->
                <div class="drawer-form-group">
                    <label for="is_active">
                        <input type="hidden" name="is_active" value="0"> <!-- ensures 0 when unchecked -->
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                        Active
                    </label>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="categoriesForm">Save</button>
        </div>

    </div>
</div>
