<?php $this->extend("layout/layout.php"); ?>
<style>
    .fb-profile {
        min-height: 950px;
    }

    .fb-profile img.fb-image-lg {
        z-index: 0;
        width: 100%;

        margin-bottom: 10px;
    }

    .fb-image-profile {
        margin: -90px 10px 0px 50px;
        z-index: 9;
        width: 20%;
        border-radius: 50%;
    }

    @media (max-width:768px) {

        .fb-profile-text>h1 {
            font-weight: 700;
            font-size: 16px;
        }

        .fb-image-profile {
            margin: -45px 10px 0px 25px;
            z-index: 9;
            width: 20%;
        }
    }
</style>

<div class="container-fluid">
    <div class="fb-profile"><img align="left" class="fb-image-lg" src="https://loremflickr.com/850/180/" alt="Profile image example" />
        <img align="left" class="fb-image-profile thumbnail" src="https://loremflickr.com/180/180/" alt="Profile image example" />
        <div class="fb-profile-text">
            <h1><?= $data["pegawai_nama"]; ?></h1>
            <p>Umur : <?= $data["pegawai_umur"]; ?> Tahun</p>
            <p>Alamat : <?= $data["pegawai_alamat"]; ?> Tahun</p>
        </div>
    </div>
</div>