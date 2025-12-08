$(document).ready(function () {

    // =======================
    // OPEN ADD DRAWER
    // =======================
    $('#orderItemAdd').on('click', function (e) {
        e.preventDefault();
        $('#orderItemForm')[0].reset();
        $('.form-error').text('');
        $('#OrderItemDrawerModal').fadeIn(200);
        $('#OrderItemDrawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE ORDER ITEM
    // =======================
    $('#orderItemForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/vendor/order-items',
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

                    closeOrderItemAddDrawer();
                    $('#orderItemForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#orderItemForm #error-${key}`).text(val[0]);
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
    // EDIT ORDER ITEM
    // =======================
    let editItemId;

    $(document).on('click', '.editOrderItem', function (e) {
        e.preventDefault();

        editItemId = $(this).data('id');
        $('.form-error').text('');
        $('#editOrderItemForm')[0].reset();

        $('#EditOrderItemDrawerModal').fadeIn(200);
        $('#EditOrderItemDrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/vendor/order-items/' + editItemId + '/edit',
            method: 'GET',

            success: function (response) {
                if (response.status === true) {
                    let d = response.data;

                    $('#edit_order_id').val(d.order_id);
                    $('#edit_product_category_id').val(d.product_category_id);
                    $('#edit_product_id').val(d.product_id);
                    $('#edit_unit_price').val(d.unit_price);
                    $('#edit_quantity').val(d.quantity);
                }
            }
        });
    });

    // =======================
    // UPDATE ORDER ITEM
    // =======================
    $('#editOrderItemForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/vendor/order-items/' + editItemId,
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

                    closeOrderItemEditDrawer();
                    $('#editOrderItemForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editOrderItemForm #error-${key}`).text(val[0]);
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
    // DELETE ORDER ITEM
    // =======================
    $(document).on('click', '.deleteOrderItem', function (e) {
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
                    url: '/vendor/order-items/' + id,
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
        closeOrderItemAddDrawer();
        closeOrderItemEditDrawer();
    });

    $('#OrderItemDrawerModal').on('click', function (e) {
        if (e.target.id === 'OrderItemDrawerModal') closeOrderItemAddDrawer();
    });

    $('#EditOrderItemDrawerModal').on('click', function (e) {
        if (e.target.id === 'EditOrderItemDrawerModal') closeOrderItemEditDrawer();
    });

});

// =======================
// FUNCTIONS
// =======================
function closeOrderItemAddDrawer() {
    $('#OrderItemDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#OrderItemDrawerModal').fadeOut(200), 250);
}

function closeOrderItemEditDrawer() {
    $('#EditOrderItemDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditOrderItemDrawerModal').fadeOut(200), 250);
}
