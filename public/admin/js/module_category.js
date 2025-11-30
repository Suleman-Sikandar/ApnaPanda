$(document).ready(function () {

    // =======================
    // OPEN ADD MODULE CATEGORY DRAWER
    // =======================
    $('#moduleCatAdd').on('click', function (e) {
        e.preventDefault();
        $('#categoriesForm')[0].reset();
        $('.form-error').text('');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE MODULE CATEGORY
    // =======================
    $('#categoriesForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/module-categories/store',
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

                    closeAddDrawer();
                    $('#categoriesForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#categoriesForm #error-${key}`).text(val[0]);
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
    // EDIT MODULE CATEGORY
    // =======================
    let editCategoryId;

    $('.editModuleCategory').on('click', function (e) {
        e.preventDefault();

        editCategoryId = $(this).data('id');

        $('.form-error').text('');
        $('#editModuleCategoryForm')[0].reset();

        $('#EditdrawerModal').fadeIn(200);
        $('#EditdrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/module-categories/edit/' + editCategoryId,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {
                    $('#edit_category_name').val(response.data.name);
                    $('#edit_display_order').val(response.data.display_order);
                    $('#edit_is_active').val(response.data.is_active).trigger('change');
                }
            }
        });
    });

    // =======================
    // UPDATE MODULE CATEGORY
    // =======================
    $('#editModuleCategoryForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/module-categories/update/' + editCategoryId,
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

                    closeEditDrawer();
                    $('#editModuleCategoryForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editModuleCategoryForm #error-${key}`).text(val[0]);
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
    // DELETE MODULE CATEGORY
    // =======================
    $('.    ').on('click', function (e) {
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
                    url: '/admin/module-categories/delete/' + id,
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
        closeAddDrawer();
        closeEditDrawer();
    });

    $('#drawerModal').on('click', function (e) {
        if (e.target.id === 'drawerModal') closeAddDrawer();
    });

    $('#EditdrawerModal').on('click', function (e) {
        if (e.target.id === 'EditdrawerModal') closeEditDrawer();
    });

});


// =======================
// FUNCTIONS
// =======================
function closeAddDrawer() {
    $('#drawerBox').removeClass('drawer-show');
    setTimeout(() => $('#drawerModal').fadeOut(200), 250);
}

function closeEditDrawer() {
    $('#EditdrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditdrawerModal').fadeOut(200), 250);
}
