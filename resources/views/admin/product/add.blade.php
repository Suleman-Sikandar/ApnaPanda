<!-- Drawer Overlay -->
<div class="drawer-overlay" id="ProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="ProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Product</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="productForm" method="POST">
                @csrf

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label for="name">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Vendor -->
                <div class="drawer-form-group">
                    <label for="vendor_id">Vendor <span class="text-danger">*</span></label>
                    <select name="vendor_id" id="vendor_id" required>
                        <option value="">-- Select Vendor --</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->users->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-vendor_id"></span>
                </div>

                <!-- Category -->
                <div class="drawer-form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-category_id"></span>
                </div>

                <!-- Price -->
                <div class="drawer-form-group">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" placeholder="Enter Product Price" required>
                    <span class="form-error text-danger" id="error-price"></span>
                </div>

                <!-- Status -->
                <div class="drawer-form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" required>
                        <option value="active">Active</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="pending_review">Pending Review</option>
                        <option value="banned">Banned</option>
                    </select>
                    <span class="form-error text-danger" id="error-status"></span>
                </div>

                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Product Images</label>
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
            <button type="button" class="btn-cancel" onclick="closeProductAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="productForm">Save</button>
        </div>

    </div>
</div>
