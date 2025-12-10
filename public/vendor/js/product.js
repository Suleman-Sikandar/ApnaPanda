/**
 * Vendor Product Management JavaScript
 * Fully Compatible with ProductService & Drawer Forms
 */

$(document).ready(function () {

    // =======================
    // OPEN ADD PRODUCT DRAWER
    // =======================
    $('#productAdd').on('click', function (e) {
        e.preventDefault();
        $('#productForm')[0].reset();
        $('.form-error').text('');
        $('#ProductDrawerModal').fadeIn(200);
        $('#ProductDrawerBox').addClass('drawer-show');
    });

    // =======================
    // ADD/REMOVE IMAGE INPUTS
    // =======================
    $(document).on('click', '.add-image-btn', function () {
        let newInput = `
            <div class="image-input-group mb-2 d-flex gap-2">
                <input type="file" name="images[]" class="form-control" accept="image/*">
                <button type="button" class="btn btn-danger remove-image-btn">-</button>
            </div>
        `;
        $(this).closest('.image-wrapper').append(newInput);
    });

    $(document).on('click', '.remove-image-btn', function () {
        $(this).closest('.image-input-group').remove();
    });

    // =======================
    // STORE PRODUCT
    // =======================
    $('#productForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/vendor/products',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    closeProductAddDrawer();
                    $('#productForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $(`#error-${key}`).text(val[0]);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Something went wrong'
                    });
                }
            }
        });
    });

    // =======================
    // EDIT PRODUCT
    // =======================
    let editProductId;

    $(document).on('click', '.editProduct', function (e) {
        e.preventDefault();

        editProductId = $(this).data('id');
        $('.form-error').text('');
        $('#editProductForm')[0].reset();

        $('#EditProductDrawerModal').fadeIn(200);
        $('#EditProductDrawerBox').addClass('drawer-show');

        $.ajax({
            url: `/vendor/products/${editProductId}/edit`,
            method: 'GET',

            success: function (response) {
                if (response.success) {
                    let p = response.product;

                    // Fill Inputs
                    $('#edit_product_id').val(p.id);
                    $('#edit_name').val(p.name);
                    $('#edit_category_id').val(p.category_id);
                    $('#edit_price').val(p.price);
                    $('#edit_stock_quantity').val(p.stock_quantity || 0);
                    $('#edit_SKU').val(p.SKU || '');
                    $('#edit_rating').val(p.rating || '');
                    $('#edit_review_count').val(p.review_count || '');
                    $('#edit_discount_percent').val(p.discount_percent || '');
                    $('#edit_discount_amount').val(p.discount_amount || '');
                    $('#edit_has_free_delivery').val(p.has_free_delivery);
                    $('#edit_delivery_charge').val(p.delivery_charge || '');

                    // Display existing images
                    $('#edit-image-preview').html('');
                    if (p.images && p.images.length > 0) {
                        p.images.forEach(function (img) {
                            $('#edit-image-preview').append(`
                                <div class="position-relative" style="width: 100px; height: 100px;">
                                    <img src="/storage/${img.image_path}" class="img-thumbnail"
                                         style="width:100%; height:100%; object-fit:cover;">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-product-image"
                                            data-image-id="${img.id}"
                                            style="padding:2px 6px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            `);
                        });
                    }
                }
            }
        });
    });

    // =======================
    // UPDATE PRODUCT (PUT)
    // =======================
    $('#editProductForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: `/vendor/products/${editProductId}`,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    closeProductEditDrawer();
                    $('#editProductForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $(`#edit-error-${key}`).text(val[0]);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Something went wrong'
                    });
                }
            }
        });
    });

    // =======================
    // DELETE PRODUCT
    // =======================
    $(document).on('click', '.deleteProduct', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {

            if (result.isConfirmed) {
                $.ajax({
                    url: `/vendor/products/${id}`,
                    method: 'DELETE',

                    success: function (response) {
                        Swal.fire('Deleted!', response.message, 'success')
                            .then(() => location.reload());
                    },

                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // =======================
    // DELETE PRODUCT IMAGE
    // =======================
    $(document).on('click', '.delete-product-image', function () {
        let imageId = $(this).data('image-id');
        let imageElement = $(this).closest('.position-relative');

        Swal.fire({
            title: 'Delete this image?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then(result => {

            if (result.isConfirmed) {
                $.ajax({
                    url: `/vendor/products/image/${imageId}`,
                    method: 'DELETE',

                    success: function (response) {
                        if (response.success) {
                            imageElement.remove();
                        }
                        Swal.fire('Deleted!', response.message, 'success');
                    },

                    error: function () {
                        Swal.fire('Error!', 'Unable to delete image.', 'error');
                    }
                });
            }
        });
    });

    // =======================
    // CLOSE DRAWERS
    // =======================
    $('.drawer-close').on('click', function () {
        closeProductAddDrawer();
        closeProductEditDrawer();
    });

    $('#ProductDrawerModal').on('click', function (e) {
        if (e.target.id === 'ProductDrawerModal') closeProductAddDrawer();
    });

    $('#EditProductDrawerModal').on('click', function (e) {
        if (e.target.id === 'EditProductDrawerModal') closeProductEditDrawer();
    });

});

// =======================
// DRAWER FUNCTIONS
// =======================
function closeProductAddDrawer() {
    $('#ProductDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#ProductDrawerModal').fadeOut(200), 250);
}

function closeProductEditDrawer() {
    $('#EditProductDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditProductDrawerModal').fadeOut(200), 250);
}
