@extends("layout.layout")

<div class="header pb-5 pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 450px; background-image: url(<?= getpic() ?>); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-7"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center mt--6">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="display-2 text-white">Resume Pembayaran</h1>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--9">
    <div class="row">

        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">My account</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($jenis == 'donasi') { ?>
                        <nu-invoice-bayar></nu-invoice-bayar>
                    <?php } else { ?>
                        <nu-invoice-tabung></nu-invoice-tabung>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <nu-card-profilcommon></nu-card-profilcommon>
        </div>
    </div>
    <div class="mb-5"></div>


    @section('scriptsheader')
    <style>
        table tr .heading {
            background-color: aquamarine;
        }

        .invoice-box {
            width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
    @endsection