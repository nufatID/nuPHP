@extends('layouts.main')

@section('title', 'Welcome Page')

@section('head')
    <link rel="stylesheet" href="path/to/your/styles.css">
@endsection

@section('content')
  
<div class="page-wrapper">

    <!-- ******Header****** -->
    <header class="header text-center">
        <div class="container-fluid">
            <div class="branding">
                <h1 class="logo">
                    <span aria-hidden="true" class="icon_documents_alt icon"></span>
                    <span class="text-highlight">{{$name}}</span><span class="text-bold">Framework</span>
                </h1>
            </div>
            <!--//branding-->
            <div class="tagline">
                <p>Bootstrap 5 dan PHP untuk membuat website dengan cepat dan mudah</p>
                <p>Designed with <i class="fas fa-heart"></i> for developers</p>

            </div>



        </div>
        <!--//container-->
    </header>
    <!--//header-->

    <section class="cards-section text-center">
        <div class="container">
            <h2 class="title">Mulailah membangun website dengan mudah dan cepat!</h2>
            <div class="intro">
                <p>Selamat anda telah menginstall NUphp Framework, dengan tampilnya halaman ini berati pengembangan website anda sudah bisa dilakukan. NUphp simple framework yang memungkinkan kita untuk membuat website dinamis dengan merubah view, tanpa perlu membuat controller dan juga Models. Karena di NUphp dengan membuat halaman views kita secara otomatis membuat model dan controller sederhana yang langsung koneksi ke database Mysql.</p>

                <!--//cta-container-->
            </div>
            <!--//intro-->
            <div id="cards-wrapper" class="cards-wrapper row">
                <div class="item item-green col-lg-4 col-sm-12">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <i class="icon fa fa-paper-plane"></i>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">Bekerja dengan Cepat</h3>
                        <p class="intro">Fokus pengembangan halaman website dengan php dan hanya berfokus pada tampilan views tanpa harus membuat controller</p>
                        <a class="link" href="#"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-pink item-2 col-lg-4 col-sm-12">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_puzzle_alt"></span>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">Komponen Website</h3>
                        <p class="intro">Templete engine memungkinkan untuk bekerja dengan komponen yang bisa kembali dipakai dimana saja</p>
                        <a class="link" href="#"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-blue col-lg-4 col-sm-12 ">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_datareport_alt"></span>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">Auto Database Model</h3>
                        <p class="intro">Dengan Auto Database Model kita hanya memangil fungsi-fungsi untuk koneksi ke database Mysql</p>
                        <a class="link" href="#"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-purple col-lg-4 col-sm-12 ">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_lifesaver"></span>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">Documentasi</h3>
                        <p class="intro">Silahkan Baca Dokumentasi untuk info lengkap tentang Framework NUphp</p>
                        <a class="link" href="faqs.html"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-primary col-lg-4 col-sm-12">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_genius"></span>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">Flexible</h3>
                        <p class="intro">Mudah untuk di kostumisasi sesuai kebutuhan pengembangan</p>
                        <a class="link" href="#"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-orange col-lg-4 col-sm-12 ">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_gift"></span>
                        </div>
                        <!--//icon-holder-->
                        <h3 class="title">License &amp; Credits</h3>
                        <p class="intro">Free lisensi untuk pengunanaan framework sederhana dan simple </p>
                        <a class="link" href="license.html"><span></span></a>
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
            </div>
            <!--//cards-->

        </div>
        <!--//container-->
    </section>
    <!--//cards-section-->
</div>
<!--//page-wrapper-->

@endsection