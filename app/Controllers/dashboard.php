<?php

use App\Model\member;
use App\Core\Controller;
use App\Model\transaction;

class dashboard extends Controller
{
     public $auth = false;

     public function index()
     {
          $totals = transaction::selectRaw('
SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
(SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
')->first();

          $total_kredit = $totals->total_kredit;
          $total_debit = $totals->total_debit;
          $rasio_kredit_debit = ($total_kredit > 0) ? round(($total_debit / $total_kredit) * 100) : 100;

          $currentMonth = date('m');
          $currentYear = date('Y');

          $totalsbulan = transaction::selectRaw('
SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
(SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
')
               ->whereRaw("strftime('%m', date) = ?", [$currentMonth])
               ->whereRaw("strftime('%Y', date) = ?", [$currentYear])
               ->first();

          $total_members = member::count();

          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;
          $anggotabulan = ($total_members > 0) ? round($totalsbulan->saldo_akhir / $total_members) : 0;

          $memberIdsWithKredit = transaction::where('type', 'kredit')
               ->where('status', 1)
               ->whereRaw("strftime('%m', date) = ?", [$currentMonth])
               ->whereRaw("strftime('%Y', date) = ?", [$currentYear])
               ->pluck('member_id')
               ->toArray();

          // Mendapatkan semua anggota yang belum melakukan transaksi kredit dengan status 1 pada bulan ini
          $membersWithoutKredit = Member::whereNotIn('id', $memberIdsWithKredit)->get();
          $utKredit = $membersWithoutKredit->count();

          // Jika jumlah data yang ditemukan kurang dari lima, tetap ambil lima data terbaru
          $latest = transaction::latest()->take($utKredit < 5 ? 5 : $utKredit - 2)->get();

          // Menggunakan compact untuk mengirimkan variabel ke view
          $data = compact('membersWithoutKredit', 'latest', 'totalsbulan', 'totals', 'rasio_kredit_debit', 'saldo_per_anggota', 'anggotabulan');

          View('dashboard/index', $data);
     }
}
