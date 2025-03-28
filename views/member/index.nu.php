@extends("layout.layout")
<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="container-fluid mt-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <h3 class="mb-0">Data Member</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Noreg</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Transaksi</th>

                                            <th scope="col"></th>
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
                                                            <img alt="Image placeholder" src="data:image/png;base64,<?= $value["gambar"] ?>">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm"><a href="<?= getBaseUrl() ?>profil/member/<?= $value["id"] ?>""><?= $value["nama"] ?></a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $value["noreg"] ?>
                                                </td>
                                                <td>
                                                    <span class=" badge badge-dot mr-4">
                                                                    <i class="bg-success"></i> completed
                                                            </span>
                                                </td>
                                                <td>
                                                    <div class="avatar-group">
                                                        <?php
                                                        for ($i = 1; $i <= 12; $i++) {
                                                        ?>
                                                            <nu-card-numcard data='{"id":"<?= $i ?>"}'><?= $i ?></nu-card-numcard>
                                                        <?php
                                                        }
                                                        ?>


                                                    </div>
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="<?= getBaseUrl() ?>transaksi/member/<?= $value->id ?>/1">Transaksi</a>
                                                            <a class="dropdown-item" href="<?= getBaseUrl() ?>profil/member/<?= $value->id ?>/1">Frofil</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer py-4">
                                <!-- <nav aria-label="...">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">
                                                <i class="fas fa-angle-left"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <i class="fas fa-angle-right"></i>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>