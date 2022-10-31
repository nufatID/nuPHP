<?php $this->extend('layout/layout.php'); ?>
<div class="container">
    waw = <?php $row = (isset($row)) ? $row : 'no';
            echo $row; ?>
    <div class="row m-5">
        <div class="col-6 m-auto p-3 bg-primary">
            <h1>Daftar New Karayawawn</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="nama" name="pegawai_nama">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Umur</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="umur" name="pegawai_umur">

                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="pegawai_alamat"></textarea>
                </div>
                <div class="form-group m-3 ">
                    <button type="submit" class="btn btn-primary btn-lg">submit</button>

                </div>
            </form>
        </div>
    </div>
</div>