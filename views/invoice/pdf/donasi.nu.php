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
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Donasi</h2>
    <p>Total Kredit: {{ $totals->total_kredit }} | Total Debit: {{ $totals->total_debit }} | Saldo Akhir: {{ $totals->saldo_akhir }} | Saldo per Anggota: {{ $saldo_per_anggota }}</p>

    <table>
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
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $transaction->judul }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->member->noreg }}</td>
                <td>{{ $transaction->member->nama }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->jumlah }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>