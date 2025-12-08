<!-- Drawer Overlay -->
<div class="drawer-overlay" id="EditPaymentMethodDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="EditPaymentMethodDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Edit Payment Method</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editPaymentMethodForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="drawer-form-group">
                    <label for="edit_payment_methode">Method Name <span class="text-danger">*</span></label>
                    <input type="text" name="payment_methode" id="edit_payment_methode" required>
                    <span class="form-error text-danger" id="error-payment_methode"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="edit_display_order">Display Order</label>
                    <input type="number" name="display_order" id="edit_display_order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

                <!-- Icon -->
                <div class="drawer-form-group">
                    <label for="edit_icon">Icon</label>
                    <div class="mb-2" id="edit-icon-preview">
                        <!-- Preview will be inserted here via JS -->
                    </div>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2">
                            <input type="file" name="icon" id="edit_icon" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <span class="form-error text-danger" id="error-icon"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closePaymentMethodEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editPaymentMethodForm">Update</button>
        </div>

    </div>
</div>
