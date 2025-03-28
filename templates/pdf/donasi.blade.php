<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color:#baffc9;
        }

        .right-align {
            text-align: right;
        }

        .page_break {
            page-break-before: always;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <h1>Laporan : {{$event->nama_acara}}</h1>
    <p>Update at: <?php echo date('l, d F Y H:i'); ?></p>

    <table>
        <tr>
            <td style="width:50%; border:0px; vertical-align: top;">
                <div class="left">
                    <h2>Detail Event Donasi</h2>
                     <table>
                        <tr>
                            <td rowspan="3" style="width: 150px; text-align: center;">
                                <img src="data:image/png;base64,{{$event->member->gambar}}" alt="Foto Pemilik" height="120" width="auto">
                            </td>
                            <th>Nama</th>
                            <td>  {{$event->member->nama}}</td>
                        </tr>
                        <tr>
                            <th>Noreg</th>
                            <td>  {{$event->member->noreg}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td> {{$event->member->job}}</td>
                        </tr>
                       
                    </table>
                    <table>
                        <tr>
                            <th>Event Id</th>
                            <td> {{$event->eventid ."-".$event->id}} </td>
                        </tr>
                          <tr>
                            <th>Nama Event</th>
                            <td> {{$event->nama_acara}} </td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td> {{$event->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>Indonesia</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>  {{$event->deskripsi}}</td>
                        </tr>
                    </table>
                    
                   
                        <h2>Laporan Pemasukan dan Pengeluaran</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pemasukan Donasi</td>
                                <td class="right-align">RP. <?= number_format($totals->total_kredit, 0, ',', '.') ?>,- </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Pemasukan</th>
                                <th class="right-align">RP. <?= number_format($totals->total_kredit, 0, ',', '.') ?>,-</th>
                            </tr>
                            <tr>
                                <td>Pengeluaran</td>
                                <td class="right-align">Rp. <?= number_format($totals->total_debit, 0, ',', '.') ?>,-</td>
                            </tr>
                          
                            <tr>
                                <th>Total Pengeluaran</th>
                                <th class="right-align">RP. <?= number_format($totals->total_debit, 0, ',', '.') ?>,-</th>
                            </tr>
                            <tr style="background-color:#ffe599">
                                <th>Saldo Akhir</th>
                                <th class="right-align">RP. <?= number_format($totals->saldo_akhir, 0, ',', '.') ?>,-</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </td>
            <td style="width:50%; border:0px; vertical-align: top;">
                <div class="right">
                    <h2>List Donatur</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Jumlah Donasi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
            @foreach($transactions->where('type', 'kredit') as $transaction)
                            <tr>
                                <td>{{ $transaction->member->nama }}</td>
                                <td class="right-align">RP. <?= number_format($transaction->jumlah, 0, ',', '.') ?>,- </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Pemasukan</th>
                                <th class="right-align">RP. <?= number_format($totals->total_kredit, 0, ',', '.') ?>,-</th>
                            </tr>
                          
                        </tfoot>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="page_break"></div>

    <h2>Laporan Donasi</h2>
   
    <!-- Tabel Transaksi Kredit -->
    <table>
        <caption>Transaksi Kredit</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>NOMER</th>
                <th>Transaksi</th>
                <th>Noreg</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($transactions->where('type', 'kredit') as $transaction)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaction->judul }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->member->noreg }}</td>
                <td>{{ $transaction->member->nama }}</td>
                <td>{{ $transaction->status }}</td>
                <td class="right-align">{{ number_format($transaction->jumlah, 0, ',', '.') }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Transaksi Debit -->
    <table>
        <caption>Transaksi Debit</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>NOMER</th>
                <th>Transaksi</th>
                <th>Noreg</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($transactions->where('type', 'debit') as $transaction)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaction->judul }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->member->noreg }}</td>
                <td>{{ $transaction->member->nama }}</td>
                <td>{{ $transaction->status }}</td>
                <td class="right-align">{{ number_format($transaction->jumlah, 0, ',', '.') }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page_break"></div>
    <p>Lampiran</p>
     <table class="table table-bordered">
            <tbody>
                <?php 
                $count = 0;
                foreach ($images as $image) {
                    if ($count % 2 == 0) {
                        echo '<tr>';
                    }
                    echo '<td style="width:50%;"><img src="data:' . $image->mime . ';base64,' . $image->base64 . '" class="img-fluid" height="800" /></td>';
                    if ($count % 2 == 1) {
                        echo '</tr>';
                    }
                    $count++;
                }
                // Jika jumlah gambar ganjil, tutup baris terakhir
                if ($count % 2 != 0) {
                    echo '<td style="width:50%;"></td></tr>';
                }
                ?>
            </tbody>
        </table>

</body>

</html>