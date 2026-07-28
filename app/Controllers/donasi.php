<?php

use App\Model\Cerit;
use App\Model\member;
use App\Model\Imgclamp;
use App\Core\Controller;
use App\Model\Don;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class donasi extends Controller
{

     public function index($id)
     {
          $page = 1;
          $perPage = 100;
          $offset = ($page - 1) * $perPage;

          $totals = Cerit::selectRaw('
        SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
        (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
    ')
               ->where('don_id', $id)
               ->first();


          $transactions = Cerit::with('member')
               ->where('don_id', $id)
               ->orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();
          $don = Don::with('member')->find($id);
          $own_id = $don->member_id;
          $memberlogin = member_login();
          $datamyown = false;
          if ($memberlogin) {
               if ($memberlogin->id == $own_id) {
                    $datamyown = true;
               }
          }
          $total_members = member::count();

          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;

          return view('transaksi/donasi', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
               'totals' => $totals,
               'saldo_per_anggota' => $saldo_per_anggota,
               'id' => $id,
               'myown' => $datamyown

          ]);
     }

     public function daftar($id, $slug)
     {
          $members = member::with('Donasi')->get();
          $don =  Don::find($id);
          $own_id = $don->member_id;
          $memberlogin = member_login();
          $data["myown"] = false;
          if ($memberlogin) {
               if ($memberlogin->id == $own_id) {
                    $data["myown"] = true;
               }
          }
          // Inisialisasi array untuk menyimpan saldo tiap member
          $memberSaldo = [];
          $totalSaldo = Cerit::where('don_id', $id)->where('type', 'kredit')->sum('jumlah');
          foreach ($members as $member) {
               $memberSaldo[] = [
                    'id' => $member->id,
                    'member_id' => $member->id,
                    'nama' => strnama($member->nama), // pastikan ada kolom 'name' atau sesuaikan dengan kolom yang ada
                    'saldo' => $member->getDonasi($id),
                    'noreg' => $member->noreg,
                    'gambar' => $member->gambar,
               ];
          }
          $data["data"] = $memberSaldo;
          $data["totalSaldo"] = $totalSaldo;
          $data["don"] = $don;
          View("member/donasi", $data);
     }


     public function excel($id)
     {
          $page = 1;
          $perPage = 100;
          $offset = ($page - 1) * $perPage;

          $totals = Cerit::selectRaw('
        SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
        (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
    ')
               ->where('don_id', $id)
               ->first();

          $transactions = Cerit::with('member') // Mengambil relasi member
               ->where('don_id', $id)
               ->orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          $total_members = member::count();
          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;

          // Create a new Spreadsheet object
          $spreadsheet = new Spreadsheet();
          $sheet = $spreadsheet->getActiveSheet();

          // Set the overall totals with merged cells
          $sheet->mergeCells('A1:H1');
          $sheet->setCellValue('A1', 'Total Kredit: ' . $totals->total_kredit . ' | Total Debit: ' . $totals->total_debit . ' | Saldo Akhir: ' . $totals->saldo_akhir . ' | Saldo per Anggota: ' . $saldo_per_anggota);

          // Set the column headers for the transactions
          $sheet->setCellValue('A3', 'No');
          $sheet->setCellValue('B3', 'NOMER');
          $sheet->setCellValue('C3', 'Transaksi');
          $sheet->setCellValue('D3', 'Noreg');
          $sheet->setCellValue('E3', 'Nama');
          $sheet->setCellValue('F3', 'Status');
          $sheet->setCellValue('G3', 'Jumlah');
          $sheet->setCellValue('H3', 'Tanggal');
          $sheet->setCellValue('I3', 'Keterangan');

          // Populate the spreadsheet with transaction data
          $rowIndex = 4;
          $no = 1;
          foreach ($transactions as $transaction) {
               $sheet->setCellValue('A' . $rowIndex, $no++);
               $sheet->setCellValue('B' . $rowIndex, $transaction->judul);
               $sheet->setCellValue('C' . $rowIndex, $transaction->type);
               $sheet->setCellValue('D' . $rowIndex, $transaction->member->noreg); // Relasi member->nama
               $sheet->setCellValue('E' . $rowIndex, $transaction->member->nama);
               $sheet->setCellValue('F' . $rowIndex, $transaction->status);
               $sheet->setCellValue('G' . $rowIndex, $transaction->jumlah);
               $sheet->setCellValue('H' . $rowIndex, $transaction->date);
               $sheet->setCellValue('I' . $rowIndex, $transaction->keterangan);

               $rowIndex++;
          }

          // Write the spreadsheet to a file
          $writer = new Xlsx($spreadsheet);
          $filename = 'donasi_' . $id . '_report.xlsx';

          // Output the file to the browser
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment;filename="' . $filename . '"');
          header('Cache-Control: max-age=0');

          $writer->save('php://output');
          exit;
     }


     public function pdf($id)
     {
          $page = 1;
          $perPage = 100;
          $offset = ($page - 1) * $perPage;

          $totals = Cerit::selectRaw('
        SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
        (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
    ')
               ->where('don_id', $id)
               ->first();

          $transactions = Cerit::with('member') // Mengambil relasi member
               ->where('don_id', $id)
               ->orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();
          $groupedTransactions = $transactions->groupBy('member_id');
          $total_members = member::count();
          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;
          $event = Don::with('member')->find($id);
          // Load view and pass the data
          $images = Imgclamp::where('don_id', $id)
               ->where('type', 'donasi')
               ->get();
          ob_start();
          Views('pdf.donasi', [
               'transactions' => $transactions,
               'totals' => $totals,
               'saldo_per_anggota' => $saldo_per_anggota,
               'total_members' => $total_members,
               'event' => $event,
               'images' => $images,
               'groupedTransactions' => $groupedTransactions
          ]);
          $html = ob_get_clean();



          // Setup Dompdf
          $options = new Options();
          $options->set('isHtml5ParserEnabled', true);
          $options->set('isRemoteEnabled', true);
          $options->set('defaultFont', 'Helvetica');
          $dompdf = new Dompdf($options);
          $dompdf->loadHtml($html);
          $dompdf->setPaper('A3', 'landscape');
          $dompdf->render();


          $dompdf->stream('donasi_report_' . $id . '.pdf', ['Attachment' => false]);
     }
}
