$(document).ready(function () {

    // =======================
    // OPEN ADD MODULE DRAWER
    // =======================
    $('#moduleAdd').on('click', function (e) {
        e.preventDefault();
        $('#addModuleForm')[0].reset();
        $('.form-error').text('');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // =======================
    // ADD MODULE SUBMIT
    // =======================
    $('#addModuleForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/modules/store',
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

                   closeEditDrawer();
                    $('#addModuleForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#modulesForm #error-${key}`).text(val[0]);
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
    // EDIT MODULE
    // =======================
    let editModuleId;

    $('.editModule').on('click', function (e) {
        e.preventDefault();

        editModuleId = $(this).data('id');

        $('.form-error').text('');
        $('#editModuleForm')[0].reset();

        $('#EditdrawerModal').fadeIn(200);
        $('#EditdrawerBox').addClass('drawer-show');

        // Fetch Module Data
        $.ajax({
            url: '/admin/modules/edit/' + editModuleId,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {
                    $('#edit_module_name').val(response.data.module_name);
                    $('#edit_display_order').val(response.data.display_order);
                    $('#edit_is_active').prop('checked', response.data.is_active == 1);
                    $('#edit_module_category_id').val(response.data.module_category_id).trigger('change');
                    $('#edit_icon_class').val(response.data.icon_class);
                    $('#edit_route').val(response.data.route);
                    $('#edit_show_in_menu').prop('checked', response.data.show_in_menu == 1);
                }
            }
        });
    });

    // =======================
    // EDIT MODULE SUBMIT
    // =======================
    $('#editModuleForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/modules/update/' + editModuleId,
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

                    closeEditDrawer();
                    $('#editModuleForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editModuleForm #error-${key}`).text(val[0]);
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
    // DELETE MODULE
    // =======================
    $('.module-btn-delete').on('click', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/modules/delete/' + id,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire('Deleted!', response.success, 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', response.error || 'Something went wrong.', 'error');
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
