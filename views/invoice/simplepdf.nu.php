<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 5px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
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
</head>

<body>


    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <?= logoimage() ?>
                            </td>

                            <td>
                                Invoice #: <span style="font-weight:bold;font-transform:uppercase;"><?= $mod->judul ?></span><br />
                                Created: <?= $mod->date ?><br />
                                Code: <span style="font-weight:bold;font-transform:uppercase;"><?= $mod->type ?>-<?= $mod->id ?></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Record by<br />
                                <?= $mod->inputBy->nama ?><br>
                                <?= $mod->inputBy->noreg ?>
                            </td>



                            <td style="margin-left: 1px;font-weight:bold">
                                An.<br>
                                <?= $mod->member->nama ?><br />
                                <?= $mod->member->noreg ?><br />
                                <?= getMemberJob($mod->member->job) ?>
                            </td>
                            <td style="width: 10%;text-align: right;">
                                <img src="data:image/png;base64,<?= $base64 ?>" height="100">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Donasi Pembayaran</td>
                <td>Donasi #</td>
            </tr>

            <tr class="details">
                <td><?= $mod->donasi->nama_acara ?></td>

                <td><?= $mod->don_id ?>-<?= $mod->donasi->eventid ?></td>
            </tr>

            <tr class="heading">
                <td>Item</td>

                <td>Price</td>
            </tr>

            <tr class="item">
                <td>1. <?= $mod->judul ?></td>

                <td>Rp. <?= number_format($mod->jumlah, 0, ',', '.') . ' ,-'; ?></td>
            </tr>
            <tr class="total">
                <td></td>

                <td>Total: Rp. <?= number_format($mod->jumlah, 0, ',', '.') . ' ,-'; ?>
                </td>
            </tr>
            <tr>
                <td></td>

                <td></td>
            </tr>
            <tr>
                <td></td>

                <td></td>
            </tr>
            <tr>
                <td>Catatan :</td>
                <td style="border: #000 1px solid;"><i><?= convertToWords($mod->jumlah) ?></i></td>
            </tr>
            <tr class="details">
                <td><?= $mod->keterangan ?></td>
                <td></td>
            </tr>
        </table>
    </div>
</body>

</html>