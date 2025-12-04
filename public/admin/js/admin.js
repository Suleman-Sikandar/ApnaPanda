$(document).ready(function () {

    // =======================
    // OPEN ADD ADMIN DRAWER
    // =======================
    $('#addminAdd').on('click', function (e) {
        e.preventDefault();
        $('#addAdminForm')[0].reset();
        $('.form-error').text('');
        $('#add_profile_image_preview').hide().attr('src', '');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // =======================
    // ADD FORM IMAGE PREVIEW
    // =======================
    $('#profile_image').change(function () {
        let reader = new FileReader();
        reader.onload = e => $('#add_profile_image_preview').attr('src', e.target.result).show();
        if (this.files[0]) reader.readAsDataURL(this.files[0]);
    });

    // =======================
    // ADD ADMIN FORM SUBMIT
    // =======================
    $('#addAdminForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/user',
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
                    $('#addAdminForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#addAdminForm #error-${key}`).text(val[0]);
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
    // EDIT USER
    // =======================
    let editUserId;

    $('.editUser').on('click', function (e) {
        e.preventDefault();

        editUserId = $(this).data('id');

        $('.form-error').text('');
        $('#editAdminForm')[0].reset();
        $('#edit_profile_image_preview').hide().attr('src', '');

        $('#EditdrawerModal').fadeIn(200);
        $('#EditdrawerBox').addClass('drawer-show');

        // Fetch User Data
        $.ajax({
            url: '/admin/user/edit/' + editUserId,
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                $('#edit_admin_name').val(response.name);
                $('#edit_admin_email').val(response.email);
                $('#edit_admin_phone').val(response.phone);
                $('#edit_admin_role').val(response.role_id).trigger('change');

                if (response.profile_image) {
                    $('#edit_profile_image_preview')
                        .attr('src', '/storage/' + response.profile_image)
                        .show();
                }
            }
        });
    });

    // =======================
    // EDIT IMAGE PREVIEW
    // =======================
    $('#edit_admin_profile_image').change(function () {
        let reader = new FileReader();
        reader.onload = e => $('#edit_profile_image_preview').attr('src', e.target.result).show();
        if (this.files[0]) reader.readAsDataURL(this.files[0]);
    });

    // =======================
    // EDIT ADMIN FORM SUBMIT
    // =======================
    $('#editAdminForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/user/update/' + editUserId,
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
                    $('#editAdminForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editAdminForm #error-${key}`).text(val[0]);
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
    // DELETE ADMIN USER
    // =======================
    $('.role-btn-delete').on('click', function (e) {
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
        })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/user/delete/' + id,
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


// Vendor Approve function 
// Vendor Approve function
$(document).ready(function() {
    $('.form').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission

        let form = $(this);
        let url = form.attr('action');

        // Check if URL contains 'approve'
        if (url.indexOf('/approve/') !== -1) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this vendor!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // check the error
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: 'Something went wrong. Please try again.'
                            });
                        }
                    });
                }
            });
        }
    });
});

