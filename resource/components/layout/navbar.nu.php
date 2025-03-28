<body class="">



    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="<?= getBaseUrl(); ?>">
                <img src="<?= getBaseUrl(); ?>assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>

            <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                <hr class="my-3">
                <h6 class="navbar-heading text-muted">MENU</h6>
                <?= App\Helper\SideMenu::render(); ?>
                <!-- Navigation -->
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Tabungan Tours</h6>
                <?= App\Helper\SideMenuTab::render(); ?>

                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Akun</h6>
                <?= App\Helper\SideMenuAkun::render(); ?>
                <div>
                    <hr>
                </div>
            </div>
            <div class="collapse navbar-collapse px-2 bg-default" id="slapse-main">
                <a href="https://nufat.id" class="nav-link pb-3 text-muted">Prod. &copy; 2024 nufat.id</a>
            </div>
        </div>

    </nav>

    <div class="main-content" style="background: #7474BF;background: -webkit-linear-gradient(to right, #348AC7, #7474BF);background: linear-gradient(to right, #348AC7, #7474BF);min-height:calc(100vh - 80px);">

        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark bg-default" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <div class="d-flex align-items-center">
                    <button id="navbar-toggle-btn" class="navbar-toggler mt--3"><span class="navbar-toggler-icon"></span></button>
                    <a class="h4 text-white text-uppercase d-none d-lg-inline-block mt-1" href="<?= getBaseUrl(); ?>">
                        <img src="<?= getBaseUrl(); ?>assets/img/logo.png" class="navbar-brand-img" height="50" alt="...">
                    </a>
                </div>
                <!-- Form -->

                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        @islogin
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body mr-3 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?= member_login()->nama; ?></span>
                                </div>
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="data:image/png;base64,<?= member_login()->gambar;  ?>" height="35">
                                </span>

                            </div>
                        </a>
                        @end
                        <nu-card-profilmenu></nu-card-profilmenu>


                    </li>
                </ul>


            </div>
        </nav>