<?php

$auth = new Auth(false);

if (isset($_SESSION['login'])) {
    header("location: " . getBaseUrl());
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <title>Login</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="nuPHP" />
    <link rel="stylesheet" href="<?= getBaseUrl(); ?>assets/css/bootstrap.min.css">

</head>

<body class="bg-success">
    <div class="container">
        <div class="row mt-5 text-center">
            <div class="col-6 m-auto mt-5">
                <div class="card borderless shadow mt-5">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400">Register</h4>
                                <hr>
                                <?php Alert::show(); ?>
                                <form method="POST" action="<?= getBaseUrl(); ?>auth/register">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="Email" placeholder="Username" name="username" value="<?= (isset($old['username'])) ? $old['username'] : ''; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="email" class="form-control" id="Email" placeholder="Email" name="email" value="<?= (isset($old['email'])) ? $old['email'] : ''; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                                    </div>
                                    <input type="hidden" name="auth_register" value="<?= Csrf::get(); ?>">
                                    <button type="submit" class="btn btn-block btn-primary mb-4">Register</button>
                                </form>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>