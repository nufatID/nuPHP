<?php

use App\Model\Don;
use App\Model\Cerit;

use App\Model\member;
use App\Model\Tabung;
use App\Models\KirimWanew as KirimWa;
use App\Core\Controller;
use App\Models\PemModel;
use App\Model\PaymentType;
use App\Model\transaction;

class pembayaran extends Controller
{
     public $auth = true;
     private $create = [];
     public function __construct()
     {
          parent::__construct(); // Memanggil konstruktor dari kelas induk
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $this->cekpost();
               $this->cekjekpost();
               vPost(['member_id', 'jenis', 'keterangan']);
               $jumlah = str_replace(['Rp. ', '.'], '', $_POST['jumlah']); // Remove formatting before inserting
               $this->create = [
                    'judul' => KasNumber($_POST['jenis'], $_POST['kriteria']),
                    'member_id' => $_POST['member_id'],
                    'jumlah' => $jumlah,
                    'payment_type' => $_POST['jenis'],
                    'type' => $_POST['type'],
                    'status' => 0,
                    'keterangan' => $_POST['keterangan'],
                    'date' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'input_by' => $_SESSION['login_member'],
               ];
          }
     }
     public function index($kre = 'kredit', $d = 'kas', $donid = null)
     {
          last_form();
          if (!in_array($kre, ['kredit', 'debit'])) {
               to_url('home');
               exit;
          }

          $data["title"] = tanggal_sekarang();
          $data["member"] = member::all();
          $data["paymentType"] = PaymentType::all();
          $data["jenis"] = $d;
          $data["type"] = $kre;
          $data["judultype"] = ($kre == 'kredit') ? 'Pembayaran' : 'Pendebitan';
          $data["donid"] = $donid;
          View("pembayaran/index", $data);
     }

     public function post_kas()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $transaction = transaction::create($this->create);
               unset($_SESSION['token_csrf']);
               $transaction_id = $transaction->id;
               KirimWa::kirim_kas($transaction_id);
               to_url("transaksi/detail/$transaction_id");
               exit;
          }
     }
     public function post_tabungan()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $transaction = Tabung::create($this->create);
               unset($_SESSION['token_csrf']);
               $transaction_id = $transaction->id;
               KirimWa::kirim_tabungan($transaction_id);
               to_url("tabungan/transaksi");
               exit;
          }
     }
     public function post_donasi($id)
     {
          $don = Don::find($id);
          if ($don) {
               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $this->create['don_id'] = $id;
                    $transaction = Cerit::create($this->create);
                    unset($_SESSION['token_csrf']);
                    $transaction_id = $transaction->id;
                    KirimWa::kirim_donasi($transaction_id);
                    to_url("donasi/daftar/" . $id . "/" . $don->slug);
                    exit;
               }
          } else {
               to_url('home');
               exit;
          }
     }
     public function resume($jenis, $id)
     {
          $data = PemModel::pilih($jenis, $id);
          $data['jenis'] = $jenis;
          View("profil/payment", $data);
     }
}
