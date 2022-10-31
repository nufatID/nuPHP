<?php $this->extend("layout/layout.php") ?>
<div class="container">
    <div class="row m-5">
        <div class="col">jumlah data = <?= $data->jumlah(); ?></div>
        <div class="col">jumlah halaman = </div>
    </div>
    <div class="row">
        <div class="col-sm-4 mx-auto text-center"><?= $data->showlist(); ?></div>

    </div>
    <table class="table table-striped">
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Alamat</th>
        </tr>
        <?php
        $no = $data->no();
        foreach ($data->pagination() as $d) {
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d['pegawai_nama']; ?></td>
                <td><?php echo $d['pegawai_umur'] . " Tahun"; ?></td>
                <td><?php echo $d['pegawai_alamat']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="row">
        <div class="col-sm-4 mx-auto text-center"><?= $data->showlist(); ?></div>

    </div>
</div>