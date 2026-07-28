<?php

use App\Core\Controller;
use App\Model\Midtran;
use App\Models\ModelPembayaran;
use App\Models\WebhookWa;
use App\Models\CheckSignature;

class Webhook extends Controller
{
    public function index()
    {
        // Ambil payload dari Midtrans
        $payload = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            res(400, ['message' => 'Invalid JSON payload']);
            return;
        }

        $isValidSignature = CheckSignature::isValidSignature($payload);
        if (!$isValidSignature) {
            return $this->res(400, ['message' => 'Invalid signature']);
        }


        $transactionStatus = $payload['transaction_status'];


        $orderId = $payload['order_id'];
        if (!is_null($payload)) {
            $filename = $orderId . '.json';
            $file_path = __DIR__ . '/../../../datasem/' . $filename; // Ganti dengan path direktori yang sesuai
            file_put_contents($file_path, json_encode($payload, JSON_PRETTY_PRINT));
        }

        $transaction = Midtran::with('member')->where('judul', $orderId)->first();

        if ($transaction) {
            switch ($transactionStatus) {
                case 'capture':
                case 'settlement':
                    $transaction->status = 1; // Sukses
                    $transaction->save();
                    ModelPembayaran::index($orderId);
                    $data = "Bang Admin Ada Transfer masuk dari \nNama : " . $transaction->member->nama . " \nnomer " . $transaction->judul . "\njumlah : Rp " . number_format($transaction->jumlah, 0, ',', '.') . ",-";
                    WebhookWa::kirim_notifadmin($data);
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $transaction->status = 0; // Gagal
                    $transaction->save();
                    break;
                default:
                    return $this->res(400, ['message' => 'Unhandled transaction status']);
            }

            return $this->res(200, ['message' => 'Transaction updated successfully']);
        }

        return $this->res(404, ['message' => 'Transaction not found']);
    }
}
