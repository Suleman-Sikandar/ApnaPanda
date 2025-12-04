<!-- Edit Drawer Overlay -->
<div class="drawer-overlay" id="EditProductDrawerModal">

    <!-- Edit Drawer -->
    <div class="drawer" id="EditProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Edit Product Category</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editProductCategoryForm" method="POST">
                @csrf

                <!-- Category Name -->
                <div class="drawer-form-group">
                    <label for="edit_category_name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="category_name" id="edit_category_name" placeholder="Enter category name" required>
                    <span class="form-error text-danger" id="error-category_name"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeProductEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editProductCategoryForm">Update</button>
        </div>

    </div>
</div>
