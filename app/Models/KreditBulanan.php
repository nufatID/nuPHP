<?php

namespace App\Models;

use App\Model\Transaction;


class KreditBulanan
{
    private $labels = [];
    private $kredit = [];

    public function __construct()
    {
        $this->kreditPerBulan();
    }

    public function kreditPerBulan()
    {
        // Menghitung saldo per anggota

        $totalKreditPerBulan = Transaction::selectRaw(
            'SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
            strftime("%m", date) AS bulan'
        )
            ->whereRaw("date >= date('now', '-6 months')")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        foreach ($totalKreditPerBulan as $item) {
            $this->labels[] = date('M', mktime(0, 0, 0, $item->bulan));
            $this->kredit[] = $item->total_kredit;
        }
    }

    public function getLabels()
    {
        return $this->labels;
    }

    public function getkredit()
    {

        return $this->kredit;
    }
}
