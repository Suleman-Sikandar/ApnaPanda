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
    // STORE PRODUCT
    // =======================
    $('#productForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/products/store',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
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
                        text: xhr.responseJSON?.error || 'Something went wrong.'
                    });
                }
            }
        });
    });

    // =======================
    // EDIT PRODUCT
    // =======================
    let editProductId;

    $('.editProduct').on('click', function (e) {
        e.preventDefault();

        editProductId = $(this).data('id');
        $('.form-error').text('');
        $('#editProductForm')[0].reset();

        $('#EditProductDrawerModal').fadeIn(200);
        $('#EditProductDrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/products/edit/' + editProductId,
            method: 'GET',

            success: function (response) {
                if (response.status === true) {
                    let d = response.data;

                    $('#edit_name').val(d.name);
                    $('#edit_vendor_id').val(d.vendor_id);
                    $('#edit_category_id').val(d.category_id);
                    $('#edit_price').val(d.price);
                    $('#edit_status').val(d.status);

                    // Populate Images
                    $('#edit-image-preview').empty();
                    if (d.images && d.images.length > 0) {
                        d.images.forEach(img => {
                            let imgHtml = `
                                <div class="position-relative image-container" data-id="${img.id}">
                                    <img src="/storage/${img.image_path}" class="rounded border" style="width: 80px; height: 80px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 delete-image-btn" style="width: 20px; height: 20px; line-height: 1;">&times;</button>
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
    // DELETE IMAGE
    // =======================
    $(document).on('click', '.delete-image-btn', function () {
        let container = $(this).closest('.image-container');
        let id = container.data('id');

        Swal.fire({
            title: 'Delete Image?',
            text: "This cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/products/image/delete/' + id,
                    method: 'GET',
                    success: function (response) {
                        if (response.status === true) {
                            container.remove();
                            Swal.fire('Deleted!', response.success, 'success');
                        } else {
                            Swal.fire('Error!', response.error, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
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
            url: '/admin/products/update/' + editProductId,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.success,
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
                        $(`#editProductForm #error-${key}`).text(val[0]);
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: xhr.responseJSON?.error || 'Something went wrong.'
                    });
                }
            }
        });
    });

    // =======================
    // DELETE PRODUCT
    // =======================
    $('.deleteProduct').on('click', function (e) {
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
                    url: '/admin/products/delete/' + id,
                    method: 'GET', // your category delete was GET? using same

                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire('Deleted!', response.success, 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', response.error || 'Failed deleting.', 'error');
                        }
                    },

                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong.', 'error');
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

    // =======================
    // DYNAMIC IMAGE INPUTS
    // =======================
    $(document).on('click', '.add-image-btn', function () {
        let inputHtml = `
            <div class="image-input-group mb-2 d-flex gap-2">
                <input type="file" name="images[]" class="form-control" accept="image/*">
                <button type="button" class="btn btn-danger remove-image-btn">-</button>
            </div>`;
        $(this).closest('.image-wrapper').append(inputHtml);
    });

    $(document).on('click', '.remove-image-btn', function () {
        $(this).closest('.image-input-group').remove();
    });

});


// =======================
// FUNCTIONS
// =======================
function closeProductAddDrawer() {
    $('#ProductDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#ProductDrawerModal').fadeOut(200), 250);
}

function closeProductEditDrawer() {
    $('#EditProductDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditProductDrawerModal').fadeOut(200), 250);
}
