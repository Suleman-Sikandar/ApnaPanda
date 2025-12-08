$(document).ready(function () {

    // =======================
    // OPEN ADD PAYMENT METHOD DRAWER
    // =======================
    $('#paymentMethodAdd').on('click', function (e) {
        e.preventDefault();
        $('#paymentMethodForm')[0].reset();
        $('.form-error').text('');
        $('#PaymentMethodDrawerModal').fadeIn(200);
        $('#PaymentMethodDrawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE PAYMENT METHOD
    // =======================
    $('#paymentMethodForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/payment-methods/store',
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

                    closePaymentMethodAddDrawer();
                    $('#paymentMethodForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#paymentMethodForm #error-${key}`).text(val[0]);
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
    // EDIT PAYMENT METHOD
    // =======================
    let editPaymentMethodId;

    $('.editPaymentMethod').on('click', function (e) {
        e.preventDefault();

        editPaymentMethodId = $(this).data('id');
        $('.form-error').text('');
        $('#editPaymentMethodForm')[0].reset();
        $('#edit-icon-preview').empty();

        $('#EditPaymentMethodDrawerModal').fadeIn(200);
        $('#EditPaymentMethodDrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/payment-methods/edit/' + editPaymentMethodId,
            method: 'GET',

            success: function (response) {
                if (response.status === true) {
                    let d = response.data;

                    $('#edit_payment_methode').val(d.payment_methode);
                    $('#edit_display_order').val(d.display_order);

                    if (d.icon) {
                        let imgHtml = `
                            <img src="/storage/${d.icon}" class="rounded border" style="height: 60px; object-fit: cover;">
                            <p class="text-muted small mt-1">Current Icon</p>
                        `;
                        $('#edit-icon-preview').html(imgHtml);
                    }
                }
            }
        });
    });

    // =======================
    // UPDATE PAYMENT METHOD
    // =======================
    $('#editPaymentMethodForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/payment-methods/update/' + editPaymentMethodId,
            method: 'POST', // Method spoofing is handled by @method('PUT') in form, but FormData needs POST
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

                    closePaymentMethodEditDrawer();
                    $('#editPaymentMethodForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editPaymentMethodForm #error-${key}`).text(val[0]);
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
    // DELETE PAYMENT METHOD
    // =======================
    $('.deletePaymentMethod').on('click', function (e) {
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
                    url: '/admin/payment-methods/delete/' + id,
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
        closePaymentMethodAddDrawer();
        closePaymentMethodEditDrawer();
    });

    $('#PaymentMethodDrawerModal').on('click', function (e) {
        if (e.target.id === 'PaymentMethodDrawerModal') closePaymentMethodAddDrawer();
    });

    $('#EditPaymentMethodDrawerModal').on('click', function (e) {
        if (e.target.id === 'EditPaymentMethodDrawerModal') closePaymentMethodEditDrawer();
    });

});

// =======================
// FUNCTIONS
// =======================
function closePaymentMethodAddDrawer() {
    $('#PaymentMethodDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#PaymentMethodDrawerModal').fadeOut(200), 250);
}

function closePaymentMethodEditDrawer() {
    $('#EditPaymentMethodDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditPaymentMethodDrawerModal').fadeOut(200), 250);
}
