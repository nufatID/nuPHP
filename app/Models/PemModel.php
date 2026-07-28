<?php

namespace App\Models;

use App\Model\Tabung;
use App\Model\transaction;
use App\Model\Cerit;
use App\Model\member;

class PemModel
{
    public static function pilih($jenis, $id)
    {
        if ($jenis == 'donasi') {
            $datamod = Cerit::with(['member', 'inputBy', 'donasi'])->where('judul', $id)->first();
            $data["mod"] = $datamod;
            $data["title"] = "Kredit";
            $data["urlcurrent"] = getCurrentUrl();
            $member = $datamod->member->id;
            $data['member'] = member::find($member);
        } elseif ($jenis == 'tabungan') {
            $datamod = Tabung::with(['member', 'inputBy'])->where('judul', $id)->first();
            $data["mod"] = $datamod;
            $data["title"] = "Transaksi Tabungan";
            $data["urlcurrent"] = getCurrentUrl();
            $member = $datamod->member->id;
            $data['member'] = member::find($member);
        } else {
            $datamod = transaction::with(['member', 'inputBy'])->where('judul', $id)->first();
            $data["mod"] = $datamod;
            $data["title"] = "Transaksi Kas";
            $data["urlcurrent"] = getCurrentUrl();
            $member = $datamod->member->id;
            $data['member'] = member::find($member);
        }
        if (!$data["mod"]) {
            View(404);
            exit();
        }
        return $data;
    }
}
