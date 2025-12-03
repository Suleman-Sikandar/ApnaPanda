$(document).ready(function () {

    // ============================
    // SEARCH ROLES
    // ============================
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

    // ============================
    // OPEN ADD ROLE DRAWER
    // ============================
    $('#roleAdd').on('click', function (e) {
        e.preventDefault();
        $('#rolesForm')[0].reset();
        $('#role_id').val('');
        $('.form-error').text('');
        $('#drawerModal').fadeIn(200);
        $('#drawerBox').addClass('drawer-show');
    });

    // ============================
    // SUBMIT ADD/EDIT FORM
    // ============================
    $(document).off('submit', '#rolesForm').on('submit', '#rolesForm', function (e) {
        e.preventDefault();
        $('.form-error').text('');

        let formData = new FormData(this);
        let roleId = $('#role_id').val();
        let url = roleId ? '/admin/roles/update/' + roleId : '/admin/roles';
        let method = 'POST';

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
                        timer: 1500,
                        showConfirmButton: false
                    });
                    closeDrawer();
                    $('#rolesForm')[0].reset();
                    setTimeout(() => location.reload(), 1500);
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

    // ============================
    // EDIT ROLE
    // ============================
    $(document).off('click', '.admin-role-btn-edit').on('click', '.admin-role-btn-edit', function (e) {
        e.preventDefault();
        let roleId = $(this).data('id');

        // Prevent multiple clicks
        if ($(this).data('loading')) return;
        $(this).data('loading', true);

        $.ajax({
            url: '/admin/roles/edit/' + roleId,
            type: 'GET',
            success: function (response) {
                $('#editRoleContainer').html(response); // load edit form
                
                // Ensure we don't have duplicate modals or lingering classes
                $('.drawer-overlay').removeClass('active');
                $('.drawer').removeClass('drawer-show');

                setTimeout(() => {
                    $('#EditdrawerModal').addClass('active');
                    $('#EditdrawerModal .drawer').addClass('drawer-show'); // Fixed selector from .drawer-box to .drawer based on blade file
                }, 10);
            },
            complete: () => {
                $(this).data('loading', false);
            }
        });
    });

    // ============================
    // DELETE ROLE
    // ============================
    $(document).off('click', '.destroyRoleBtn').on('click', '.destroyRoleBtn', function (e) {
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
                    url: '/admin/roles/' + id,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.success,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            closeDrawer();
                            $('#rolesForm')[0].reset();
                            setTimeout(() => location.reload(), 1500);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // ============================
    // CLOSE DRAWERS
    // ============================
    $(document).off('click', '.drawer-close').on('click', '.drawer-close', function () {
        closeDrawer();
    });

    $(document).off('click', '.drawer-overlay').on('click', '.drawer-overlay', function (e) {
         if (e.target === this) {
            closeDrawer();
        }
    });

});

// ============================
// CLOSE DRAWER FUNCTION
// ============================
function closeDrawer() {
    $('.drawer-box').removeClass('drawer-show');
    setTimeout(() => {
        $('.drawer-modal').removeClass('active');
        $('#drawerModal').fadeOut(200);
        $('#EditdrawerModal').removeClass('active');
    }, 250);
}
