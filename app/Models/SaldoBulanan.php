<?php

namespace App\Models;

use App\Model\Transaction;

class SaldoBulanan
{
     public $labelsaldo = [];
     public  $saldoPerBulan = [];

     public function __construct()
     {
          $this->getSaldoPerBulan();
     }
     public function getSaldoPerBulan()
     {
          $totalSaldoPerBulan = Transaction::selectRaw('
    SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_saldo,
    strftime("%Y-%m", date) AS bulan
')
               ->whereRaw("date >= date('now', '-6 months')")
               ->groupBy('bulan')
               ->orderBy('bulan')
               ->get();

          foreach ($totalSaldoPerBulan as $item) {
               // Extract month and year from the bulan field
               $bulanYear = explode('-', $item->bulan);
               $monthName = date("M", mktime(0, 0, 0, $bulanYear[1], 1));

               $this->labelsaldo[] = $monthName;
               $this->saldoPerBulan[] = $item->total_saldo;
          }
     }
}
