<?php

namespace App\Models;
use App\Model\Pesan;
use App\Model\Cerit;
use App\Model\Tabung;
use GuzzleHttp\Client;
use App\Model\transaction;

class KirimWanew
{
 
    public static function kirim_kas($id)
    {
    $datana = transaction::with(['member', 'inputBy'])->find($id);
      $pesan = new Pesan();
        $pesan->nomor = $datana->member->telp;
        $pesan->jenis ='pdflink';
        $pesan->lampiran = getBaseUrl() . "invoice/pdfkredit/kas/" . $id . "/invoice.pdf";
     $pesan->text = "invoice dengan nomer ".$datana->judul." atas nama ".$datana->member->nama." sebesar Rp. ".$datana->jumlah.",-";
        $pesan->created_at = now();
        $pesan->updated_at = now();
        $pesan->save();
     
    }
    public static function kirim_tabungan($id)
    {
        $datana = Tabung::with(['member', 'inputBy'])->find($id);
     $pesan = new Pesan();
        $pesan->nomor = $datana->member->telp;
        $pesan->jenis ='pdflink';
        $pesan->lampiran = getBaseUrl() . "invoice/pdfkredit/tabungan/" . $id . "/invoice.pdf";
       $pesan->text = "invoice dengan nomer ".$datana->judul." atas nama ".$datana->member->nama." sebesar Rp. ".$datana->jumlah.",-";
        $pesan->created_at = now();
        $pesan->updated_at = now();
        $pesan->save();   
     
    }
    public static function kirim_donasi($id)
    {
        $datana = Cerit::with(['member', 'inputBy', 'donasi'])->find($id);
        $pesan = new Pesan();
        $pesan->nomor = $datana->member->telp;
         $pesan->jenis ='pdflink';
        $pesan->lampiran = getBaseUrl() . "invoice/pdfkredit/donasi/" . $id . "/invoice.pdf";
        $pesan->text = "invoice dengan nomer ".$datana->judul." atas nama ".$datana->member->nama." sebesar Rp. ".$datana->jumlah.",-";
        $pesan->created_at = now();
        $pesan->updated_at = now();
        $pesan->save();
     
    }
}
