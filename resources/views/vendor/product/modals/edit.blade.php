<!-- Drawer Overlay -->
<div class="drawer-overlay" id="EditProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="EditProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Edit Product</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_product_id" name="product_id">

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label for="edit_name">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="edit-error-name"></span>
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
                    <span class="form-error text-danger" id="edit-error-category_id"></span>
                </div>

                <!-- Price -->
                <div class="drawer-form-group">
                    <label for="edit_price">Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="edit_price" placeholder="Enter product price" step="0.01" required>
                    <span class="form-error text-danger" id="edit-error-price"></span>
                </div>

                <!-- Stock Quantity -->
                <div class="drawer-form-group">
                    <label for="edit_stock_quantity">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="edit_stock_quantity" placeholder="Enter stock quantity" min="0">
                    <span class="form-error text-danger" id="edit-error-stock_quantity"></span>
                </div>

                <!-- SKU -->
                <div class="drawer-form-group">
                    <label for="edit_SKU">SKU</label>
                    <input type="text" name="SKU" id="edit_SKU" placeholder="Enter product SKU">
                    <span class="form-error text-danger" id="edit-error-SKU"></span>
                </div>
                
                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Product Images</label>
                    <!-- Existing Images Preview -->
                    <div id="edit-image-preview" class="d-flex gap-2 flex-wrap mb-3"></div>
                    <!-- Add More Images -->
                    <label class="text-muted mb-1">Add More Images</label>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2 d-flex gap-2">
                            <input type="file" name="images[]" class="form-control" accept="image/*">
                            <button type="button" class="btn btn-success add-image-btn">+</button>
                        </div>
                    </div>
                    <small class="text-muted">Select new images to add (existing images will be kept)</small>
                    <span class="form-error text-danger" id="edit-error-images"></span>
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
