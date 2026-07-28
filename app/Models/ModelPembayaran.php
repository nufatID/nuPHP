<?php

namespace App\Models;

use App\Model\Tabung;
use App\Model\Cerit;
use App\Model\Midtran;
use App\Model\transaction as Transaction;

class ModelPembayaran
{
     public static function index($data)
     {
          $ambilmid = Midtran::where('judul', $data)->first();
          if (!$ambilmid) {
               return 'Midtrans data not found';
          }

          $prefix = substr($data, 0, 3);
          $datain = [
               'judul' => $ambilmid->judul,
               'member_id' => $ambilmid->member_id,
               'jumlah' => $ambilmid->jumlah,
               'payment_type' => $ambilmid->payment_type,
               'type' => $ambilmid->type,
               'status' => 0,
               'keterangan' => $ambilmid->keterangan,
               'date' => $ambilmid->date,
               'created_at' => now(),
               'updated_at' => now(),
               'input_by' => $ambilmid->input_by,
               'don_id' => $ambilmid->don_id,
          ];

          switch ($prefix) {
               case 'KAS':
                    return self::createOrUpdateTransaction($datain, $ambilmid);
               case 'TAB':
                    return self::createOrUpdateTabung($datain, $ambilmid);
               case 'DON':
                    return self::createOrUpdateCerit($datain, $ambilmid);
               default:
                    return 'UNKNOWN';
          }
     }

     private static function createOrUpdateTransaction($data, $midtran)
     {
          $transaction = Transaction::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
          if ($transaction) {
               $midtran->delete();
          }
          KirimWanew::kirim_kas($transaction->id);
          return $transaction;
     }

     private static function createOrUpdateTabung($data, $midtran)
     {
          $tabung = Tabung::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
          if ($tabung) {
               $midtran->delete();
          }
          KirimWanew::kirim_tabungan($tabung->id);
          return $tabung;
     }

     private static function createOrUpdateCerit($data, $midtran)
     {
          $cerit = Cerit::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
          if ($cerit) {
               $midtran->delete();
          }
          KirimWanew::kirim_donasi($cerit->id);
          return $cerit;
     }
}
