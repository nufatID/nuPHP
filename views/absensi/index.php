<?php $this->extend("layout/layout.php") ?>


<div class="container-fluid mt-2">
    <div class="row m-2">
        <div class="col-lg-4"> <a href="<?= getBaseUrl(); ?>absensi/insert" class="btn btn-primary">tambah</a></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <form target="" method="POST">
                <div class="input-group">
                    <input type="hidden" name="cari">
                    <input type="search" name="q" id="form1" class="form-control rounded" placeholder="Cari..." aria-describedby="search-addon" autocomplete="off" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>


        </div>

    </div>
    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= Alert::show(); ?>
            <?= $data->pagelist(); ?></div>

    </div>
    <div class="container-fluid">
        <?php
        if (isset($_GET['q']) || isset($_POST['cari'])) {
            echo $data->getCari(['pegawai_nama', 'pegawai_alamat'], ['ID', 'NAMA', 'UMUR', 'ALAMAT']);
        } else {
            echo $data->getTablePage(['ID', 'NAMA', 'UMUR', 'ALAMAT']);
        }  ?>
    </div>

    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= $data->pagelist(); ?></div>

    </div>
</div>