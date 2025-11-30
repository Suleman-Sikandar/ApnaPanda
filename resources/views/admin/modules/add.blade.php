<!-- Drawer Overlay -->
<div class="drawer-overlay" id="drawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="drawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Module</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="addModuleForm" method="POST" action="">
                @csrf

                <!-- Module Name -->
                <div class="drawer-form-group">
                    <label for="module_name">Module Name <span class="text-danger">*</span></label>
                    <input type="text" name="module_name" id="module_name" placeholder="Enter module name" required>
                    <span class="form-error text-danger" id="error-module_name"></span>
                </div>

                <!-- Module Category -->
                <div class="drawer-form-group">
                    <label for="module_category_id">Category <span class="text-danger">*</span></label>
                    <select name="module_category_id" id="module_category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-module_category_id"></span>
                </div>

                <!-- Route -->
                <div class="drawer-form-group">
                    <label for="route">Route</label>
                    <input type="text" name="route" id="route" placeholder="Enter route URL">
                    <span class="form-error text-danger" id="error-route"></span>
                </div>

                <!-- Icon Class -->
                <div class="drawer-form-group">
                    <label for="icon_class">Icon Class</label>
                    <input type="text" name="icon_class" id="icon_class" placeholder="Enter icon class">
                    <span class="form-error text-danger" id="error-icon_class"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" name="display_order" id="display_order" placeholder="Enter display order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

                <!-- Show in Menu -->
                <div class="drawer-form-group">
                    <label for="show_in_menu">
                        <input type="hidden" name="show_in_menu" value="0">
                        <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1">
                        Show in Menu
                    </label>
                </div>

                <!-- Is Active -->
                <div class="drawer-form-group">
                    <label for="is_active">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                        Active
                    </label>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="addModuleForm">Save</button>
        </div>

    </div>
</div>

<!-- Inline CSS for drawer inputs -->
<style>
.drawer-form-group input[type="text"],
.drawer-form-group input[type="number"],
.drawer-form-group select {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.drawer-form-group label {
    display: block;
    margin-bottom: 4px;
    font-weight: 500;
}
</style>
