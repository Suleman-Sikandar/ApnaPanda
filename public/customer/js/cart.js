document.addEventListener("DOMContentLoaded", function () {
    function updateTotals() {
        let subtotal = 0;

        document.querySelectorAll('.cart-item').forEach(item => {
            let price = parseFloat(item.dataset.price);
            let discount = parseFloat(item.dataset.discount);
            let displayPrice = price - (price * discount / 100);
            let qty = parseInt(item.querySelector('.qty-value').innerText);
            let itemTotal = displayPrice * qty;
            item.querySelector('.item-total-value').innerText = itemTotal.toFixed(0);
            subtotal += itemTotal;
        });

        let delivery = parseFloat(document.querySelector('#delivery-fee').innerText.replace("Rs. ", "")) || 0;

        let gst = subtotal * 0.05;
        let totalPay = subtotal + delivery + gst;

        document.querySelector('#subtotal-amount').innerText = "Rs. " + subtotal.toFixed(0);
        document.querySelector('#gst-amount').innerText = "Rs. " + gst.toFixed(0);
        document.querySelector('#total-amount').innerText = "Rs. " + totalPay.toFixed(0);
    }

    function updateQtyOnServer(id, qty) {
        fetch("/cart/update-qty", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id: id,
                quantity: qty
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status) {
                let item = document.querySelector(`.cart-item[data-id="${data.cartItem.id}"]`);
                if (item) {
                    item.dataset.price = data.cartItem.price; // Update price from server
                    item.querySelector('.price-value').innerText = data.cartItem.price;
                    item.querySelector('.qty-value').innerText = data.cartItem.quantity; // Ensure UI matches server quantity
                }
                updateTotals();
            } else {
                console.error("Failed to update quantity on server", data.message);
                // Potentially revert UI quantity or show error message
            }
        })
        .catch(error => {
            console.error("Error updating quantity:", error);
            // Revert quantity in UI or show error message
        });
    }

    document.querySelectorAll('.qty-increase').forEach(btn => {
        btn.addEventListener('click', function () {
            let item = this.closest('.cart-item');
            let qtyBox = item.querySelector('.qty-value');
            let newQty = parseInt(qtyBox.innerText) + 1;

            qtyBox.innerText = newQty;

            updateQtyOnServer(item.dataset.id, newQty);
        });
    });

    document.querySelectorAll('.qty-decrease').forEach(btn => {
        btn.addEventListener('click', function () {
            let item = this.closest('.cart-item');
            let qtyBox = item.querySelector('.qty-value');
            let currentQty = parseInt(qtyBox.innerText);

            if (currentQty > 1) {
                let newQty = currentQty - 1;
                qtyBox.innerText = newQty;

                updateQtyOnServer(item.dataset.id, newQty);
            }
        });
        
    });

    // Initial load totals
    updateTotals();

    
});

$(document).ready(function(){
     $('.deleteProduct').on('click', function (e) {
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
                    url: '/cart/customer/delete/' + id,
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
})