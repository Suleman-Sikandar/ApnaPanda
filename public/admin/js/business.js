$(document).ready(function () {

    // =======================
    // OPEN ADD BUSINESS DRAWER
    // =======================
    $('#businessAdd').on('click', function (e) {
        e.preventDefault();
        $('#businessForm')[0].reset();
        $('.form-error').text('');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE BUSINESS
    // =======================
    $('#businessForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/business/store',
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
                    $('#businessForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#businessForm #error-${key}`).text(val[0]);
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
    // EDIT BUSINESS
    // =======================
    let editBusinessId;

    $('.editBusiness').on('click', function (e) {
        e.preventDefault();

        editBusinessId = $(this).data('id');

        $('.form-error').text('');
        $('#editBusinessForm')[0].reset();

        $('#EditdrawerModal').fadeIn(200);
        $('#EditdrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/business/edit/' + editBusinessId,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                if (response.status === true) {
                    $('#edit_name').val(response.data.name);
                    $('#edit_display_order').val(response.data.display_order);
                }
            }
        });
    });

    // =======================
    // UPDATE BUSINESS
    // =======================
    $('#editBusinessForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/business/update/' + editBusinessId,
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
                    $('#editBusinessForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editBusinessForm #error-${key}`).text(val[0]);
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
    // DELETE BUSINESS
    // =======================
    $('.deleteBusiness').on('click', function (e) {
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
                    url: '/admin/business/delete/' + id,
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
