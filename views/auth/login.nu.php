<?php

use App\Core\Auth;
use App\Core\Alert;
use App\Core\Csrf;

new Auth(false);
if (isset($_SESSION['login'])) {
    header("location: " . getBaseUrl());
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        UNDERBODY ASSY
    </title>
    <!-- Favicon -->
    <link href="<?= getBaseUrl(); ?>assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?= getBaseUrl(); ?>assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="<?= getBaseUrl(); ?>assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?= getBaseUrl(); ?>assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="bg-default">
    <div class="container-fluid">
        <!-- Navbar -->

        <!-- Header -->
        <div class="header bg-gradient-primary py-lg-5">
            <div class="container">
                <div class="header-body text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Welcome!</h1>

                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--3 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card borderless shadow mt-5">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h4 class="mb-3 f-w-400">Login</h4>
                                    <hr>
                                    <?php Alert::show(); ?>
                                    <form method="POST" action="<?= getBaseUrl(); ?>auth/login">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="Email" placeholder="Username" name="username" value="<?= (isset($old['username'])) ? $old['username'] : ''; ?>" autocomplete="off" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                                        </div>
                                        <input type="hidden" name="auth_login" value="<?= Csrf::get(); ?>">
                                        <button type="submit" class="btn btn-block btn-primary mb-4">Login</button>
                                    </form>
                                    <hr>
                                    <p class="mb-2 text-muted">Lupa Pasword? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--   Core   -->
    <script src="<?= getBaseUrl(); ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="<?= getBaseUrl(); ?>assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <!--   Argon JS   -->
    <script src="<?= getBaseUrl(); ?>assets/js/argon-dashboard.min.js?v=1.1.2"></script>

</body>

</html>