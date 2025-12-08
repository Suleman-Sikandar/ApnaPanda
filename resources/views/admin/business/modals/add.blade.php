<!-- Drawer Overlay -->
<div class="drawer-overlay" id="drawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="drawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Business</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="businessForm" method="POST">
                @csrf

                <!-- Name -->
                <div class="drawer-form-group">
                    <label for="name">Business Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter business name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="display_order">Display Order <span class="text-danger">*</span></label>
                    <input type="number" name="display_order" id="display_order" placeholder="Enter display order" required>
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="businessForm">Save</button>
        </div>

    </div>
</div>
