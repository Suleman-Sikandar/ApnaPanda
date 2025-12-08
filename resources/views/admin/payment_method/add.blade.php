<!-- Drawer Overlay -->
<div class="drawer-overlay" id="PaymentMethodDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="PaymentMethodDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add Payment Method</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="paymentMethodForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="drawer-form-group">
                    <label for="payment_methode">Method Name <span class="text-danger">*</span></label>
                    <input type="text" name="payment_methode" id="payment_methode" placeholder="Enter payment method name" required>
                    <span class="form-error text-danger" id="error-payment_methode"></span>
                </div>

                <!-- Display Order -->
                <div class="drawer-form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" name="display_order" id="display_order" placeholder="Enter display order">
                    <span class="form-error text-danger" id="error-display_order"></span>
                </div>

                <!-- Icon -->
                <div class="drawer-form-group">
                    <label for="icon">Icon</label>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2">
                            <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <span class="form-error text-danger" id="error-icon"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closePaymentMethodAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="paymentMethodForm">Save</button>
        </div>

    </div>
</div>
