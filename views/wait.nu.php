<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Notifikasi Pembayaran</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .loading {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .svg-container {
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }

        .made-with-love {
            margin-top: 20px;
            font-size: 0.8em;
            color: #555;
        }

        .made-with-love i {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="loading">
            <p>Menunggu Prosess pembayaran...</p>
            <!-- <div class="svg-container">
                <svg version="1.1" id="L1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <circle fill="none" stroke="#000" stroke-width="6" stroke-miterlimit="15" stroke-dasharray="14.2472,14.2472" cx="50" cy="50" r="47">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="5s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </circle>
                    <circle fill="none" stroke="#000" stroke-width="1" stroke-miterlimit="10" stroke-dasharray="10,10" cx="50" cy="50" r="39">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="5s" from="0 50 50" to="-360 50 50" repeatCount="indefinite" />
                    </circle>
                    <g fill="#000">
                        <rect x="30" y="35" width="5" height="30">
                            <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.1" />
                        </rect>
                        <rect x="40" y="35" width="5" height="30">
                            <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.2" />
                        </rect>
                        <rect x="50" y="35" width="5" height="30">
                            <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.3" />
                        </rect>
                        <rect x="60" y="35" width="5" height="30">
                            <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.4" />
                        </rect>
                        <rect x="70" y="35" width="5" height="30">
                            <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.5" />
                        </rect>
                    </g>
                </svg>
            </div> -->
            <div class="loader">
                <svg version="1.1" id="L2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <circle fill="none" stroke="#000" stroke-width="4" stroke-miterlimit="10" cx="50" cy="50" r="48" />
                    <line fill="none" stroke-linecap="round" stroke="#ff0" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="85" y2="50.5">
                        <animateTransform attributeName="transform" dur="2s" type="rotate" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </line>
                    <line fill="none" stroke-linecap="round" stroke="#0ff" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="49.5" y2="74">
                        <animateTransform attributeName="transform" dur="15s" type="rotate" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </line>
                </svg>
            </div>
        </div>
        <div id="status">Silakan tunggu, pembayaran Anda sedang diproses.</div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function getParameterByName(name, url = window.location.href) {
                name = name.replace(/[\[\]]/g, '\\$&');
                let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
                let results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            const orderId = getParameterByName('order_id');
            if (!orderId) {
                document.getElementById('status').innerText = 'Order ID tidak ditemukan.';
                return;
            }

            const statusCheckUrl = `/midtrans/check/wait?order_id=${orderId}`;

            function checkPaymentStatus() {
                fetch(statusCheckUrl)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Payment status:', data);
                        if (data.status === 'success') {
                            document.getElementById('status').innerText = 'Pembayaran Anda berhasil!';
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil',
                                text: 'Pembayaran Anda telah selesai.',
                                willClose: () => {
                                    window.location.href = data.link; // Redirect to index page after success
                                }
                            });
                        } else if (data.status === 'failed') {
                            document.getElementById('status').innerText = 'Pembayaran Anda gagal. Silakan coba lagi.';
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Pembayaran Anda tidak berhasil. Silakan coba lagi.'
                            });
                        } else {
                            setTimeout(checkPaymentStatus, 5000); // Check again after 5 seconds
                        }
                    })
                    .catch(error => {
                        console.error('Error checking payment status:', error);
                        setTimeout(checkPaymentStatus, 5000); // Retry after 5 seconds on error
                    });
            }

            checkPaymentStatus();
        });
    </script>
</body>

</html>