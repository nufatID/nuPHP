 function submit() {
        $("#submitbayar").hide();
        Swal.fire({
            title: 'Loading...',
            html: 'mohon tunggu sebentar....',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        var form = document.getElementById('formbayar');
        var formData = new FormData(form);
        var paymentMethod = document.getElementById('paymentMethod').value;

        fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (paymentMethod === 'deep' && data.deeplinkUrl) {
                    window.location.href = data.deeplinkUrl;
                } else if (paymentMethod === 'snap' && data.snapToken) {
                    snap.pay(data.snapToken, {
                        language: 'id',
                        onSuccess: function(result) {

                            window.location.href = '<?= to_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=success';
                        },
                        onPending: function(result) {
                            window.location.href = '<?= to_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=success';
                        },
                        onError: function(result) {

                            window.location.href = '<?= to_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=failed';
                        },
                        onClose: function() {
                            console.log('Customer closed the popup without finishing the payment');
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Payment Error',
                        text: data.message || 'Invalid payment method or missing token/URL.'
                    });
                    console.error('Failed to process payment:', data);
                }
            })
            .catch(error => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: error.message || 'Please try again later.'
                });
                console.error('Error:', error);
            });
    }