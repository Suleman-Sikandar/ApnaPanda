<!-- Drawer Overlay -->
<div class="drawer-overlay" id="ProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="ProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Add New Product</h2>
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
                    <input type="number" name="price" id="price" placeholder="Enter product price" step="0.01" required>
                    <span class="form-error text-danger" id="error-price"></span>
                </div>

                <!-- Stock Quantity -->
                <div class="drawer-form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" placeholder="Enter stock quantity" min="0" value="0">
                    <span class="form-error text-danger" id="error-stock_quantity"></span>
                </div>

                <!-- SKU -->
                <div class="drawer-form-group">
                    <label for="SKU">SKU</label>
                    <input type="text" name="SKU" id="SKU" placeholder="Enter product SKU">
                    <span class="form-error text-danger" id="error-SKU"></span>
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
