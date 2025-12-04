$(document).ready(function () {

    // =======================
    // OPEN ADD PRODUCT CATEGORY DRAWER
    // =======================
    $('#productCatAdd').on('click', function (e) {
        e.preventDefault();
        $('#productCategoryForm')[0].reset();
        $('.form-error').text('');
        $('#ProductDrawerModal').fadeIn(200);
        $('#ProductDrawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE PRODUCT CATEGORY
    // =======================
    $('#productCategoryForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/product-categories/store',
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
                    $('#productCategoryForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#productCategoryForm #error-${key}`).text(val[0]);
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
    // EDIT PRODUCT CATEGORY
    // =======================
    let editProductCategoryId;

    $('.editProductCategory').on('click', function (e) {
        e.preventDefault();

        editProductCategoryId = $(this).data('id');
        $('.form-error').text('');
        $('#editProductCategoryForm')[0].reset();

        $('#EditProductDrawerModal').fadeIn(200);
        $('#EditProductDrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/product-categories/edit/' + editProductCategoryId,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {
                    $('#edit_category_name').val(response.data.category_name);
                }
            }
        });
    });

    // =======================
    // UPDATE PRODUCT CATEGORY
    // =======================
    $('#editProductCategoryForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/product-categories/update/' + editProductCategoryId,
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
                    $('#editProductCategoryForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editProductCategoryForm #error-${key}`).text(val[0]);
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
    // DELETE PRODUCT CATEGORY
    // =======================
    $('.deleteProductCategory').on('click', function (e) {
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
                    url: '/admin/product-categories/delete/' + id,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

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
