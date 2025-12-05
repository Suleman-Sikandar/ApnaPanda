<!-- Edit Drawer Overlay -->
<div class="drawer-overlay" id="EditProductDrawerModal">

    <!-- Edit Drawer -->
    <div class="drawer" id="EditProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Edit Product</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editProductForm" method="POST">
                @csrf

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label for="edit_name">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Vendor -->
                <div class="drawer-form-group">
                    <label for="edit_vendor_id">Vendor <span class="text-danger">*</span></label>
                    <select name="vendor_id" id="edit_vendor_id" required>
                        <option value="">-- Select Vendor --</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->users->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-vendor_id"></span>
                </div>

                <!-- Category -->
                <div class="drawer-form-group">
                    <label for="edit_category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="edit_category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-category_id"></span>
                </div>

                <!-- Price -->
                <div class="drawer-form-group">
                    <label for="edit_price">Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="edit_price" placeholder="Enter product price" required>
                    <span class="form-error text-danger" id="error-price"></span>
                </div>

                <!-- Status -->
                <div class="drawer-form-group">
                    <label for="edit_status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="edit_status" required>
                        <option value="active">Active</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="pending_review">Pending Review</option>
                        <option value="banned">Banned</option>
                    </select>
                    <span class="form-error text-danger" id="error-status"></span>
                </div>

                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Add More Images</label>
                    <div id="edit-image-preview" class="d-flex gap-2 flex-wrap mb-2"></div>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2 d-flex gap-2">
                            <input type="file" name="images[]" class="form-control" accept="image/*">
                            <button type="button" class="btn btn-success add-image-btn">+</button>
                        </div>
                    </div>
                    <span class="form-error text-danger" id="error-images"></span>
                </div>


            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeProductEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editProductForm">Update</button>
        </div>

    </div>
</div>
