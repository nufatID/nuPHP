@extends('layout.layout')


<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">

            <!-- ******Header****** -->
            <header class="header text-center" style="min-height:calc(100vh - 335px);">
                <div class="container">
                    <div class="branding">
                        <h1 class="logo">
                            <span aria-hidden="true" class="fas fa-exclamation-circle text-danger" style="font-size: 100px;"></span>
                            <p>
                                <span class="text-highlight" style="font-size: xxx-large;">Error </span>
                            </p>
                            <p>
                            <h1 class=" text-bold">404
                            </h1>
                            </p>
                        </h1>
                    </div>
                    <!--//branding-->
                    <div class="tagline">
                        <h1 class="logo text-warning">MAAF ...!! <br>HALAMAN TIDAK DITEMUKAN</h1>
                        <?php if (isset($_GET['error'])) : ?>
                            <h2><?= $_GET['error'] ?></h2>
                        <?php endif; ?>
                    </div>



                </div>
                <!--//container-->
            </header>
            <!--//header-->

        </div>
    </div>
</div>