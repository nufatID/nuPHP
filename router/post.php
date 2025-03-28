<?php

use App\Core\Controller;
use App\Model\Don;

class post extends Controller
{
  public function index(){
    $data=Don::find(42);
    var_dump($data["status"]);
  }
 
 public function update() {
    // Periksa apakah data dikirim melalui metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari permintaan POST
        $data = $_POST['data'];
        $csrf = $_POST['csrf'];
        $id = $_POST['id'];

        // Verifikasi token CSRF
        if ($csrf !== $_SESSION['token_csrf']) {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Invalid CSRF token']);
            exit;
        }

        // Temukan model Don berdasarkan ID
        $flight = Don::find($id);
        if ($flight) {
            // Perbarui status berdasarkan data yang diterima
            if ($data == 1) {
                $flight->status = 1;
            } else if ($data == 2) {
                $flight->status = 2;
            } else {
                $flight->status = 3;
            }

            // Simpan perubahan
            $flight->save();

            // Siapkan respons
            $response = ['message' => 'Status updated successfully', 'status' => $flight->status];
        } else {
            // Jika model tidak ditemukan, kembalikan pesan error
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Don not found']);
            exit;
        }

        // Kembalikan respons sebagai JSON
        header('Content-Type: application/json');
        echo json_encode(['response' => $response]);
    } else {
        // Jika bukan metode POST, kembalikan pesan error
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(['error' => 'Method not allowed']);
    }
}
 
 
}