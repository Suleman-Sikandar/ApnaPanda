<!-- Drawer Overlay -->
<div class="drawer-overlay" id="ProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="ProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Product Category</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="productCategoryForm" method="POST" action="">
                @csrf

                <!-- Category Name -->
                <div class="drawer-form-group">
                    <label for="category_name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="category_name" id="category_name" placeholder="Enter Category name" required>
                    <span class="form-error text-danger" id="error-category_name"></span>
                </div>

                <div class="drawer-form-group">
                    <label for="icon_class">Icon Class <span class="text-danger">*</span></label>
                    <input type="text" name="icon_class" id="icon_class" placeholder="Enter Icon class" required>
                    <span class="form-error text-danger" id="error-icon_class"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeProductAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="productCategoryForm">Save</button>
        </div>

    </div>
</div>
