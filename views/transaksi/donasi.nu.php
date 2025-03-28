@extends("layout.layout")
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <nu-element-stat></nu-element-stat>
        </div>
    </div>
</div>


<div class="container-fluid mt--7 pb-5" style="min-height:calc(100vh - 30px);">

    <div class="header-body">

        <div class="container-fluid mt-1">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Data Transaksi</h3>
                        </div>
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Transaksi</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Noreg</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="width: 2%;"></th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($transactions as $nomor => $value) { ?>

                                            <tr>
                                                <td>
                                                    <?= $nomor + 1 ?>
                                                </td>
                                                <td>
                                                    <a href="<?= getBaseUrl() . "pembayaran/resume/donasi/" . $value["judul"]; ?>"> <?= $value["judul"] ?></a>
                                                </td>
                                                <td>
                                                    <?= strnama($value->member->nama); ?>
                                                </td>
                                                <td>
                                                    <?= $value->member->noreg; ?>
                                                </td>
                                                <td>
                                                    <span class="badge badge-dot mr-4">
                                                        <?php if ($value->type == 'debit') { ?>
                                                            <i class="bg-danger"></i>
                                                        <?php } else { ?>
                                                            <i class="bg-success"></i>
                                                        <?php } ?>
                                                        <?= $value->type; ?>
                                                    </span>
                                                </td>

                                                <td>Rp.</td>
                                                <td style="text-align:right;font-weight:bold;font-size:16px;">
                                                    <?= number_format($value->jumlah, 0, ',', '.') . ' ,-'; ?>

                                                </td>
                                                <td>
                                                    <?= $value->date; ?>
                                                </td>


                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="<?= getBaseUrl() . "pembayaran/resume/donasi/" . $value["judul"]; ?>">Lihat Detail</a>
                                                            <a class="dropdown-item" href="#">Lihat Invoice</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $nomor++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer py-4">
                                <div class="d-flex justify-content-between">
                                    <?php if ($currentPage > 1) : ?>
                                        <a href="<?php echo getBaseUrl() . "transaksi/data/" . $currentPage - 1; ?>" class="btn btn-primary">Previous</a>
                                    <?php endif; ?>
                                    <?php if (count($transactions) == $perPage) : ?>
                                        <a href="<?php echo getBaseUrl() . "transaksi/data/" . $currentPage + 1; ?>" class="btn btn-primary">Next</a>
                                    <?php endif; ?>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <?php if ($myown) { ?>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#uploadModal">
                                                Upload File
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <div class="col"></div>

                                    <div class="col-2">
                                        <a href="<?php echo getBaseUrl() . "donasi/excel/" . $id; ?>" class="btn btn-primary btn-block">Export Excel</a>
                                    </div>
                                    <div class="col-2">
                                        <a href="<?php echo getBaseUrl() . "donasi/pdf/" . $id; ?>" class="btn btn-primary btn-block">Report PDF</a>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm">
                    <div class="form-group">
                        <label for="fileInput">Choose file</label>
                        <input type="file" class="form-control-file" id="fileInput" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


@section('scriptsfooter')
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();

            var fileInput = $('#fileInput')[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var base64String = e.target.result.split(',')[1];
                var mimeType = fileInput.type;

                $.ajax({
                    url: '<?= getBaseUrl() . "upload/base/" . $id ?>',
                    method: 'POST',
                    data: {
                        file: base64String,
                        mime: mimeType
                    },
                    success: function(response) {
                        alert('File uploaded successfully!');
                        $('#uploadModal').modal('hide');
                        //   loadImages(); // Refresh the images table
                    },
                    error: function() {
                        alert('Error uploading file.');
                    }
                });
            };
            reader.readAsDataURL(fileInput);
        });

        function loadImages() {
            $.ajax({
                url: 'fetch_images.php',
                method: 'GET',
                success: function(data) {
                    $('#imagesTable tbody').html(data);
                },
                error: function() {
                    alert('Error fetching images.');
                }
            });
        }

        // Load images on page load
        //loadImages();
    });
</script>
@endsection