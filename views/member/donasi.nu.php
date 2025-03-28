@extends("layout.layout")
<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="container-fluid mt-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card  shadow">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                <div class="col-md-8 d-flex">
                                    <h2 class="mb-0" style="text-transform:uppercase"><?= $don->nama_acara ?></h2>

                                </div>
                                <div class="col-md-4 d-flex justify-content-end">
                                    <?php if ($myown) { ?>
                                        <a href="<?= getBaseUrl(); ?>pembayaran/kredit/donasi/<?= $don->id ?>" class="btn btn-primary ml-3 bg-success" id="tkredit" style="display: <?= ($don->status == 1) ? 'block' : 'none'; ?>;">Input Donasi</a>
                                    <?php } ?>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= getBaseUrl(); ?>donasi/<?= $don->id . "/" . $don->slug ?>">Lihat Detail</a>
                                            <a class="dropdown-item" href="#">Lihat Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-items-center table-yellow table-flush">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" style="width: 5%;font-size: 14px">No</th>
                                            <th scope="col" style="width: 25%;font-size: 14px">Nama</th>
                                            <th scope="col" style="width: 5%;font-size: 14px">Noreg</th>
                                            <th scope="col" style="width: 2%;font-size: 14px"></th>
                                            <th scope="col" style="width: 15%;font-size: 14px">Saldo</th>
                                            <th scope="col" style="width: 5%;font-size: 14px">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($data as $no => $value) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no + 1 ?>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <a href="#" class="avatar rounded-circle mr-3">
                                                            <img alt="Image placeholder" src="data:image/png;base64,<?= $value["gambar"] ?>" height="45">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm"><a href="<?= getBaseUrl() ?>profil/member/<?= $value["id"] ?>"><?= $value["nama"] ?></a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $value["noreg"] ?>
                                                </td>
                                                <td>
                                                    Rp.
                                                </td>
                                                <td style="text-align:right;font-weight:bold;font-size:18px;">
                                                    <?= number_format($value["saldo"], 0, ',', '.') ?>,-
                                                </td>
                                                <td><a class="btn btn-sm btn-primary" href="<?= getBaseUrl() ?>transaksi/member/<?= $value["id"] ?>/1">Lihat Transaksi</a></td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-dark text-white">
                                            <th scope="col" style="width: 5%"></th>
                                            <th scope="col" colspan="2" style="text-align:right;font-size:18px;font-weight:bold;">Saldo Total</th>
                                            <th scope="col" style="width: 2%">Rp.</th>
                                            <th style="text-align:right;font-weight:bold;font-size:18px;">
                                                <?= number_format($totalSaldo, 0, ',', '.') ?>,-
                                            </th>
                                            <th></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                <?php if ($myown) { ?>
                                    <div class="col-md-8 d-flex">

                                        <a href="<?= getBaseUrl(); ?>pembayaran/debit/donasi/<?= $don->id ?>" class="btn btn-primary ml-3 bg-danger" id="tdebit" style="display: <?= ($don->status == 1) ? 'block' : 'none'; ?>;">DEBIT</a>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-end">
                                        <input type="checkbox" id="toggle-event" <?= ($don->status == 1) ? "checked" : "" ?> data-toggle="toggle" data-on="Aktif" data-off="Sudah Selesai" data-onstyle="primary" data-offstyle="danger">
                                        <div id="console-event"></div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scriptsheader')

<link rel="stylesheet" href="<?= getBaseUrl(); ?>assets/css/main/btogel.css">

@endsection
@section('scriptsfooter')
<script src="<?= getBaseUrl(); ?>assets/js/main/btogel.js"></script>

<script>
    $(function() {
        $('#toggle-event').change(function() {
            var attrib = $(this).prop('checked');
            var dataToSend = attrib ? 1 : 2;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Tampilkan atau sembunyikan elemen
            if (attrib) {
                $("#tdebit").show();
                $("#tkredit").show();
            } else {
                $("#tdebit").hide();
                $("#tkredit").hide();
            }

            // Kirim data menggunakan AJAX
            $.ajax({
                url: '<?= getBaseUrl() ?>post/update', // Ganti dengan URL endpoint Anda yang tepat
                method: 'POST',
                data: {
                    data: dataToSend,
                    csrf: csrfToken,
                    id: <?= $don->id ?>
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
@endsection