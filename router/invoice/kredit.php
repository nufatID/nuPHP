<?php

use App\Model\Cerit;
use App\Model\Tabung;
use App\Model\transaction;

class kredit
{
    public function donasi($id)
    {
        $datana = Cerit::with(['member', 'inputBy', 'donasi'])->find($id);
        if (!$datana) {
            $datana = Cerit::with(['member', 'inputBy', 'donasi'])->where('judul', $id)->first();
        }
        if (!$datana) {
            View('404');
            exit();
        }
        $data["mod"] = $datana;
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Donasi Underbody';
        $data['model'] = 'don';
        View('invoice/tabung', $data);
    }
    public function tabungan($id)
    {
        $datana = Tabung::with(['member', 'inputBy'])->find($id);
        if (!$datana) {
            $datana = Tabung::with(['member', 'inputBy'])->where('judul', $id)->first();
        }
        if (!$datana) {
            View('404');
            exit();
        }
        $data["mod"] = $datana;
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Tabungan Underbody';
        $data['model'] = 'tab';
        View('invoice/tabung', $data);
    }
    public function kas($id)
    {
        $datana = transaction::with(['member', 'inputBy'])->find($id);
        if (!$datana) {
            $datana = transaction::with(['member', 'inputBy'])->where('judul', $id)->first();
        }
        if (!$datana) {
            View('404');
            exit();
        }
        $data["mod"] = $datana;
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Kas Bulanan Underbody';
        $data['model'] = 'tab';
        View('invoice/tabung', $data);
    }
}
