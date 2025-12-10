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
            <form class="drawer-form" id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" id="edit_product_id" name="product_id">

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label>Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="edit-error-name"></span>
                </div>

                <!-- Category -->
                <div class="drawer-form-group">
                    <label>Category <span class="text-danger">*</span></label>
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
                    <label>Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="edit_price" placeholder="Enter product price" step="0.01" required>
                    <span class="form-error text-danger" id="edit-error-price"></span>
                </div>

                <!-- Stock Quantity -->
                <div class="drawer-form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="edit_stock_quantity" min="0">
                    <span class="form-error text-danger" id="edit-error-stock_quantity"></span>
                </div>

                <!-- SKU -->
                <div class="drawer-form-group">
                    <label>SKU</label>
                    <input type="text" name="SKU" id="edit_SKU" placeholder="Enter product SKU">
                    <span class="form-error text-danger" id="edit-error-SKU"></span>
                </div>

                <!-- Rating -->
                <div class="drawer-form-group">
                    <label>Rating (0-5)</label>
                    <input type="number" name="rating" id="edit_rating" step="0.1" min="0" max="5">
                    <span class="form-error text-danger" id="edit-error-rating"></span>
                </div>

                <!-- Review Count -->
                <div class="drawer-form-group">
                    <label>Review Count</label>
                    <input type="number" name="review_count" id="edit_review_count" min="0">
                    <span class="form-error text-danger" id="edit-error-review_count"></span>
                </div>

                <!-- Discount Percentage Only -->
                <div class="drawer-form-group">
                    <label>Discount Percentage (%)</label>
                    <input type="number" name="discount_percent" id="edit_discount_percent" step="0.01" min="0" max="100">
                    <span class="form-error text-danger" id="edit-error-discount_percent"></span>
                </div>

                <!-- Free Delivery -->
                <div class="drawer-form-group">
                    <label>Free Delivery</label>
                    <select name="has_free_delivery" id="edit_has_free_delivery">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <span class="form-error text-danger" id="edit-error-has_free_delivery"></span>
                </div>

                <!-- Delivery Charge -->
                <div class="drawer-form-group">
                    <label>Delivery Charge (PKR)</label>
                    <input type="number" name="delivery_charge" id="edit_delivery_charge" step="0.01" min="0">
                    <span class="form-error text-danger" id="edit-error-delivery_charge"></span>
                </div>

                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Product Images</label>

                    <!-- Existing Images Preview -->
                    <div id="edit-image-preview" class="d-flex flex-wrap gap-2 mb-3"></div>

                    <!-- Add New Images -->
                    <label class="text-muted mb-1">Add More Images</label>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2 d-flex gap-2">
                            <input type="file" name="images[]" accept="image/*" class="form-control">
                            <button type="button" class="btn btn-success add-image-btn">+</button>
                        </div>
                    </div>
                    <small class="text-muted">You may upload new images. Existing images will not be removed automatically.</small>

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
