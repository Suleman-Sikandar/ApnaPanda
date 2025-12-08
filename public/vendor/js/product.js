/**
 * Product Management JavaScript
 * Handles CRUD operations for vendor products
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
    // ADD MORE IMAGE INPUTS
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

    // Remove image input
    $(document).on('click', '.remove-image-btn', function () {
        $(this).closest('.image-input-group').remove();
    });

    // =======================
    // STORE PRODUCT
    // =======================
    $('#productForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/vendor/products',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.success === true) {
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
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#productForm #error-${key}`).text(val[0]);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
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

        // Fetch product data
        $.ajax({
            url: `/vendor/products/${editProductId}/edit`,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.success === true) {
                    let product = response.product;

                    // Populate form fields
                    $('#edit_product_id').val(product.id);
                    $('#edit_name').val(product.name);
                    $('#edit_category_id').val(product.category_id);
                    $('#edit_price').val(product.price);
                    $('#edit_stock_quantity').val(product.stock_quantity || 0);
                    $('#edit_SKU').val(product.SKU || '');
                    $('#edit_description').val(product.description || '');

                    // Display existing images
                    $('#edit-image-preview').html('');
                    if (product.images && product.images.length > 0) {
                        product.images.forEach(function (image) {
                            let imgHtml = `
                                <div class="position-relative" style="width: 100px; height: 100px;">
                                    <img src="/storage/${image.image_path}" class="img-thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-product-image" 
                                            data-image-id="${image.id}" style="padding: 2px 6px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            `;
                            $('#edit-image-preview').append(imgHtml);
                        });
                    }
                }
            }
        });
    });

    // =======================
    // UPDATE PRODUCT
    // =======================
    $('#editProductForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: `/vendor/products/${editProductId}`,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.success === true) {
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
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editProductForm #edit-error-${key}`).text(val[0]);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                }
            }
        });
    });

    // =======================
    // DELETE PRODUCT
    // =======================
    $(document).on('click', '.deleteProduct', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: `/vendor/products/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                    success: function (response) {
                        if (response.success === true) {
                            Swal.fire('Deleted!', response.message, 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', response.message || 'Failed deleting.', 'error');
                        }
                    },

                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    }
                });

            }
        });
    });

    // =======================
    // DELETE PRODUCT IMAGE
    // =======================
    $(document).on('click', '.delete-product-image', function (e) {
        e.preventDefault();

        let imageId = $(this).data('image-id');
        let imageElement = $(this).closest('.position-relative');

        Swal.fire({
            title: 'Delete this image?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/vendor/products/image/${imageId}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                    success: function (response) {
                        if (response.success === true) {
                            imageElement.remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    },

                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Failed to delete image', 'error');
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
