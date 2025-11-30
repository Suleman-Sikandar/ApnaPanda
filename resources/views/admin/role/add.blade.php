<!-- Drawer Overlay -->
<div class="drawer-overlay" id="drawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="drawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Role</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="rolesForm" method="POST" action="">
                @csrf

                <!-- Role Name -->
                <div class="drawer-form-group">
                    <label for="name">Role Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter role name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" name="display_order" id="display_order" placeholder="Enter display order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="rolesForm">Save</button>
        </div>

    </div>
</div>
