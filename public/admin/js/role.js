$(document).ready(function () {

    // Custom search for grid layout (role cards)
    $('#roleSearchInput').on('keyup', function () {
        var searchValue = $(this).val().toLowerCase();

        $('.admin-role-card').each(function () {
            var roleName = $(this).find('.admin-role-card-title').text().toLowerCase();

            if (roleName.indexOf(searchValue) > -1) {
                $(this).fadeIn(300);
            } else {
                $(this).fadeOut(300);
            }
        });
    });

    // Open drawer
    $('#roleAdd').on('click', function (e) {
        e.preventDefault();
        $('#rolesForm')[0].reset();
        $('#role_id').val('');
        $('.form-error').text('');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // Submit add/edit form
    $('#rolesForm').on('submit', function (e) {
        e.preventDefault();
        $('.form-error').text('');
        let formData = new FormData(this);
        let roleId = $('#role_id').val();
        let url = roleId ? 'roles/' + roleId : 'roles';
        let method = roleId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    closeDrawer();
                    $('#rolesForm')[0].reset();
                    // Refresh page or dynamically append/edit row
                    location.reload(); // simplest solution
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#error-${key}`).text(val[0]);
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

    // Delete role
    $(document).on('click', '.destroyRoleBtn', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This role will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'roles/' + id,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.success,
                                timer: 1500, // show for 1.5 seconds
                                showConfirmButton: false
                            });

                            closeDrawer();
                            $('#rolesForm')[0].reset();

                            // Refresh page after 1.5s
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // Close drawer
    $('.drawer-close').on('click', function () {
        closeDrawer();
    });
    $('#drawerModal').on('click', function (e) {
        if (e.target.id === 'drawerModal') closeDrawer();
    });

});

// Close drawer function
function closeDrawer() {
    $('#drawerBox').removeClass('drawer-show');
    setTimeout(() => { $('#drawerModal').fadeOut(200); }, 250);
}
