<?php
use App\Model\transaction;
use App\Model\Tabung;
use App\Model\Cerit;
use App\Core\Controller;
class activity extends Controller
{
  public $auth = true;
  public function index()
  {
  
    View("profil/sactivity");
  }
  public function tab()
  {
   

if (isset($_GET['tab'])) {
  $tab =$_GET['tab'];
  switch ($tab) {
     case 'kas':
                return $this->getkas();
            case 'tabungan':
                return $this->getabungan();
            case 'donasi':
                return $this->getdonasi();
          
            default:
                return "Invalid tab";
        }
  
}
  }
  private function getabungan()
  {
    $member = member_login()->id;
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
           $transactions = Tabung::where('member_id', $member) // Menambahkan kondisi where
               ->orderBy('created_at', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return Element('tabel/tebeldata', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     
  }
    private function getdonasi()
  {
    $member = member_login()->id;
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
           $transactions = Cerit::where('member_id', $member) // Menambahkan kondisi where
               ->orderBy('created_at', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return Element('tabel/tebeldata', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     
  }
    private function getkas()
  {
    $member = member_login()->id;
          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
           $transactions = transaction::where('member_id', $member) // Menambahkan kondisi where
               ->orderBy('created_at', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return Element('tabel/tebeldata', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     
  }
  
}