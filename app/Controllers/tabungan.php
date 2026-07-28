<?php

use App\Core\Controller;
use App\Model\Tabung;
use App\Model\member as memberModel;

class tabungan extends Controller
{
     public function index()
     {
          $members = memberModel::with('tabungan')->get();

          // Inisialisasi array untuk menyimpan saldo tiap member
          $memberSaldo = [];
          $totalSaldo = Tabung::sum('jumlah');
          foreach ($members as $member) {
               $memberSaldo[] = [
                    'id' => $member->id,
                    'member_id' => $member->id,
                    'nama' => strnama($member->nama), // pastikan ada kolom 'name' atau sesuaikan dengan kolom yang ada
                    'saldo' => $member->saldo,
                    'noreg' => $member->noreg,
                    'gambar' => $member->gambar,
               ];
          }
          $data["data"] = $memberSaldo;
          $data["totalSaldo"] = $totalSaldo;
          View("member/tabung", $data);
     }
     public function transaksi()
     {
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Tabung::orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/tabung', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
     public function getSaldo()
     {
          // Ambil semua member dan hitung saldo mereka
          $members = memberModel::with('tabungan')->get();

          // Inisialisasi array untuk menyimpan saldo tiap member
          $memberSaldo = [];

          foreach ($members as $member) {
               $memberSaldo[] = [
                    'member_id' => $member->id,
                    'nama' => $member->name, // pastikan ada kolom 'name' atau sesuaikan dengan kolom yang ada
                    'saldo' => $member->saldo
               ];
          }

          return response(200, $memberSaldo);
     }
}
