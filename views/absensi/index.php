<?php $this->extend("layout/layout.php") ?>


<div class="container-fluid mt-2">

    <a href="<?= getBaseUrl(); ?>absensi/insert" class="btn btn-primary">tambah</a>
    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= $data->pagelist(); ?></div>

    </div>
    <div class="container-fluid">
        <?= $data->getTablePage(); ?>
    </div>

    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= $data->pagelist(); ?></div>

    </div>
</div>