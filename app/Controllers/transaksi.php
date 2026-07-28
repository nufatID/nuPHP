<?php

use App\Core\Controller;
use App\Model\transaction;

class transaksi extends Controller
{
     public function index()
     {
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Transaction::orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/index', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
     public function data($page)
     {

          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Transaction::orderBy('created_at', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/index', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
     public function member($member, $page)
     {
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Transaction::where('member_id', $member) // Menambahkan kondisi where
               ->orderBy('created_at', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/index', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
}
