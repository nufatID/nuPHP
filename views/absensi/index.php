<?php $this->extend("layout/layout.php") ?>
<div class="container mt-5">
    <!-- <div class="row m-5">
        <div class="col">jumlah data = <?= $data->jumlah(); ?></div>
        <div class="col">jumlah halaman = <?= $data->halaman(); ?></div>
    </div> -->
    <!-- <div class="row">
        <div class="col"><?= var_dump($data->CekNumeric()); ?></div>
    </div> -->
    <a href="<?= getBaseUrl(); ?>/absensi/insert" class="btn btn-primary">tambah</a>
    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center"><?= $data->pagelist(); ?></div>

    </div>
    <div class="container">
        <?= $data->getTablePage(); ?>
    </div>

    <div class="row m-5">
        <div class="col-sm-4 mx-auto text-center"><?= $data->pagelist(); ?></div>

    </div>
</div>