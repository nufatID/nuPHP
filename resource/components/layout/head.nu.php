<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="Deskripsi Singkat Situs : KAS UB" />
<!-- Mendeklarasikan warna yang muncul pada address bar Chrome versi seluler -->
<meta name="theme-color" content="#414f57" />
<!-- Mendeklarasikan ikon untuk iOS -->
    <meta name="csrf-token" content="<?= App\core\Csrf::get(); ?>">
    <title>
        UNDERBODY ASSY - KAS KEUANGAN
    </title>
    <!-- Favicon -->
    <link href="<?= getBaseUrl(); ?>assets/img/brand/favicon.png" rel="icon" type="image/png">
     <link href="<?= getBaseUrl(); ?>manifest.json" rel="manifest">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?= getBaseUrl(); ?>assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="<?= getBaseUrl(); ?>assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->


    <link href="<?= getBaseUrl(); ?>assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
    <?= $this['scriptsheader'] ?>
    <style>
        #sidenav-main {
            transition: transform 0.3s ease-in-out;
        }

        #sidenav-main.hide {
            transform: translateX(-100%);
        }



        .main-content.full-width {
            margin-left: 0;
        }
    </style>

</head>