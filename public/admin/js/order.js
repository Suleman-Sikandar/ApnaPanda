$(document).ready(function () {

    // =======================
    // OPEN ADD ORDER DRAWER
    // =======================
    $('#orderAdd').on('click', function (e) {
        e.preventDefault();
        $('#orderForm')[0].reset();
        $('.form-error').text('');
        $('#OrderDrawerModal').fadeIn(200);
        $('#OrderDrawerBox').addClass('drawer-show');
    });

    // =======================
    // STORE ORDER
    // =======================
    $('#orderForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/orders/store',
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

                    closeOrderAddDrawer();
                    $('#orderForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#orderForm #error-${key}`).text(val[0]);
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
    // EDIT ORDER
    // =======================
    let editOrderId;

    $('.editOrder').on('click', function (e) {
        e.preventDefault();

        editOrderId = $(this).data('id');
        $('.form-error').text('');
        $('#editOrderForm')[0].reset();

        $('#EditOrderDrawerModal').fadeIn(200);
        $('#EditOrderDrawerBox').addClass('drawer-show');

        // Fetch record
        $.ajax({
            url: '/admin/orders/edit/' + editOrderId,
            method: 'GET',

            success: function (response) {
                if (response.status === true) {
                    let d = response.data;

                    $('#edit_customer_id').val(d.customer_id);
                    $('#edit_vendor_id').val(d.vendor_id);
                    $('#edit_order_status').val(d.order_status);
                    $('#edit_payment_method_id').val(d.payment_method_id);
                    $('#edit_payment_amount').val(d.payment_amount);
                    $('#edit_delivery_address').val(d.delivery_address);
                    $('#latitude_edit').val(d.latitude);
                    $('#longitude_edit').val(d.longitude);
                    $('#city_edit').val(d.city);
                    $('#province_edit').val(d.province);
                    $('#country_edit').val(d.country);
                    $('#postal_code_edit').val(d.postal_code);

                    // Re-center map if lat/lng are available
                    if (d.latitude && d.longitude && typeof mapEdit !== 'undefined') {
                        const pos = { lat: parseFloat(d.latitude), lng: parseFloat(d.longitude) };
                        mapEdit.setCenter(pos);
                        markerEdit.setPosition(pos);
                        mapEdit.setZoom(17);
                    }

                    // Populate logs
                    let logsHtml = '';
                    // Check for both snake_case and camelCase just to be safe
                    let logs = d.status_logs || d.statusLogs || [];

                    if (logs.length > 0) {
                        logs.forEach(log => {
                            // Simple date formatting
                            let date = new Date(log.created_at).toLocaleString();
                            // User display: try name, fallback to type
                            let userName = 'System';
                            if (log.user_type === 'admin' && log.admin) {
                                userName = log.admin.name;
                            } else if (log.user) {
                                userName = log.user.name;
                            }

                            logsHtml += `
                                <tr>
                                    <td>
                                        <small class="text-muted">${log.old_status || 'New'}</small> 
                                        &rarr; 
                                        <strong>${log.status_changed_to}</strong>
                                    </td>
                                    <td>${userName} <small class="text-muted">(${log.user_type})</small></td>
                                    <td><small>${date}</small></td>
                                </tr>
                            `;
                        });
                    } else {
                        logsHtml = '<tr><td colspan="3" class="text-center text-muted">No history found</td></tr>';
                    }
                    $('#orderStatusLogsBody').html(logsHtml);
                }
            }
        });
    });

    // =======================
    // UPDATE ORDER
    // =======================
    $('#editOrderForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/admin/orders/update/' + editOrderId,
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

                    closeOrderEditDrawer();
                    $('#editOrderForm')[0].reset();
                    location.reload();
                }
            },

            error: function (xhr) {
                $('.form-error').text('');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $(`#editOrderForm #error - ${key} `).text(val[0]);
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
    // DELETE ORDER
    // =======================
    $('.deleteOrder').on('click', function (e) {
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
                    url: '/admin/orders/delete/' + id,
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
        closeOrderAddDrawer();
        closeOrderEditDrawer();
    });

    $('#OrderDrawerModal').on('click', function (e) {
        if (e.target.id === 'OrderDrawerModal') closeOrderAddDrawer();
    });

    $('#EditOrderDrawerModal').on('click', function (e) {
        if (e.target.id === 'EditOrderDrawerModal') closeOrderEditDrawer();
    });

});

// =======================
// FUNCTIONS
// =======================
function closeOrderAddDrawer() {
    $('#OrderDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#OrderDrawerModal').fadeOut(200), 250);
}

function closeOrderEditDrawer() {
    $('#EditOrderDrawerBox').removeClass('drawer-show');
    setTimeout(() => $('#EditOrderDrawerModal').fadeOut(200), 250);
}
