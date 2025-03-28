@extends("layout.layout")

<?php $slot = $jenis; ?>

<div class="header  pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 600px;  background: linear-gradient(150deg, #39ef74, #4600f1 100%); background-size: cover; background-position: center top;">



    <!-- Page content -->
    <div class="container-fluid mb-3 mt-3">
        <div class="row">


            <div class="col-xl-8 order-xl-1 mt-3">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0" style="text-transform: uppercase;">UBkas - Payment</h3>
                            </div>
                            <div class="col-4 text-right">


                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div id="result-json"></div>
                        </div>
                        <form action="<?= getBaseUrl() . "midtrans/pembayaran/post" . ($donid != null ? '/' . $donid : ''); ?>" method="post" id="formbayar">

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Nama</label>
                                            <input type="text" id="input-first-name" class="form-control form-control-alternative" name="Nama" value="<?= member_login()->nama ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Noreg</label>
                                            <input type="text" id="input-last-name" class="form-control form-control-alternative" name="Noreg" value="<?= member_login()->noreg ?>" readonly required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">PEMBAYARAN</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-jumlah">Jumlah Rupiah</label>
                                            <input id="input-jumlah" class="form-control form-control-alternative" type="text" value="Rp. 50.000" name="jumlah" required>
                                            <p id="output-terbilang" class="terbilang-box"></p>
                                        </div>
                                    </div>
                                    <?php if ($slot == 'kas') : ?>
                                        <input type="hidden" name="jenis" readonly value="KAS">
                                    <?php elseif ($slot == 'donasi') : ?>
                                        <input type="hidden" name="jenis" readonly value="DON">
                                    <?php else : ?>
                                        <input type="hidden" name="jenis" readonly value="TAB">
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <div class="grow-wrap">
                                        <textarea rows="4" class="form-control form-control-alternative" placeholder="Keterangan" name="keterangan" onInput="this.parentNode.dataset.replicatedValue = this.value" required>pembayaran <?= date('F') . ' ' . date('Y') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="input-id" name="member_id" value="<?= member_login()->id ?>" class="form-control form-control-alternative">
                                    <input type="hidden" id="input-csrf" name="csrf" value="<?= App\core\Csrf::get(); ?>">

                                    <input type="hidden" id="input-kride" name="type" value="<?= $type; ?>">
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-payment-method">Metode Pembayaran</label>
                                    <select class="form-control form-control-alternative" id="paymentMethod" name="payment_method">
                                        <option value="deep">GoPay Aplikasi</option>
                                        <option value="snap">Transfer Bank</option>
                                        <option value="snap">Gopay Qrcode</option>
                                        <option value="snap">Shopeepay Qrcode</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row" id="submitbayar" style="display: block;">
                                <div class="col-md-6 offset-md-3">
                                    <a href="<?= getBaseUrl() . "midtrans/pembayaran" . $slot; ?>" class="btn btn-secondary btn-lg mr-3 mt-4" role="button" aria-pressed="true"><i class="fas fa-ban"></i> Clear</a>
                                    <button type="submit" class="btn btn-primary btn-lg mt-4" role="button" aria-pressed="true"><i class="fas fa-paper-plane"></i> Submit Pembayaran</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 mt-3">
                <nu-pro data='{"id":10}'>slot</nu-pro>

                <!-- <nu-bayar-addtype data='{"id":10}'></nu-bayar-addtype> -->

            </div>



        </div>
    </div>
</div>

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?= Components('confirmModal', ['id' => 'confirmModal2']); ?>


@section('scriptsfooter')

<script>
    $(document).ready(function() {
        $('#formbayar').on('submit', function(event) {
            event.preventDefault();
            $('#confirmModal2').modal('show');
        });
        $('#confirmModal2btn').on('click', function() {
            submit();
            $('#confirmModal2').modal('hide');
        });
    });
</script>
<script>
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

                            window.location.href = '<?= get_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=success';
                        },
                        onPending: function(result) {
                            window.location.href = '<?= get_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=success';
                        },
                        onError: function(result) {

                            window.location.href = '<?= get_url('midtrans/check') ?>?order_id=' + result.order_id + '&result=failed';
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
</script>
<script src="<?= getBaseUrl(); ?>assets/js/main/terbilang.js"></script>

@endsection


@section('scriptsheader')
<link rel="stylesheet" href="<?= getBaseUrl(); ?>assets/css/main/sweat.min.css">
<script src="<?= getBaseUrl(); ?>assets/js/main/sweat.js"></script>
<style>
    .terbilang-box {
        padding: 10px;
        font-style: italic;
        color: gray;
    }

    .grow-wrap {
        /* easy way to plop the elements on top of each other and have them both sized based on the tallest one's height */
        display: grid;
    }

    .grow-wrap::after {
        /* Note the weird space! Needed to preventy jumpy behavior */
        content: attr(data-replicated-value) " ";

        /* This is how textarea text behaves */
        white-space: pre-wrap;

        /* Hidden from view, clicks, and screen readers */
        visibility: hidden;
    }

    .grow-wrap>textarea {
        /* You could leave this, but after a user resizes, then it ruins the auto sizing */
        resize: none;

        /* Firefox shows scrollbar on growth, you can hide like this. */
        overflow: hidden;
    }

    .grow-wrap>textarea,
    .grow-wrap::after {
        /* Identical styling required!! */

        padding: 0.5rem;
        font: inherit;

        /* Place on top of each other */
        grid-area: 1 / 1 / 2 / 2;
    }
</style>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
@endsection