<?php

use Midtrans\Config;
use Midtrans\Snap;

class transaksi
{
    public function index()
    {
        // Set Your server key
        Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

        // Required
        $transaction_details = array(
            'order_id' => 'KAS'.rand(),
            'gross_amount' => 100000 // no decimal allowed for credit card
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => 100000,
            'quantity' => 1,
            'name' => "Bayar Kas Bulan Juni"
        );

        // Optional
        $item_details = array($item1_details);

        // Optional
        $customer_details = array(
            'first_name' => "Yana",
            'last_name' => "Suheryana",
            'email' => "yanasuheryana@gmail.com",
            'phone' => "0484849938282"
        );

        // Optional, remove this to display all available payment methods
        $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel', 'gopay', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'permata_va', 'bni_va', 'other_va', 'shopeepay');

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'language' => 'id'
        );

        $snapToken = Snap::getSnapToken($transaction);

        return view('transaksi/paymentonline', [
            'clientKey' => $clientKey,
            'snapToken' => $snapToken
        ]);
    }

    public function callback()
    {
        $notif = new Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $this->updateOrderStatus($order_id, 'challenge');
                } else {
                    $this->updateOrderStatus($order_id, 'success');
                }
            }
        } else if ($transaction == 'settlement') {
            $this->updateOrderStatus($order_id, 'settlement');
        } else if ($transaction == 'pending') {
            $this->updateOrderStatus($order_id, 'pending');
        } else if ($transaction == 'deny') {
            $this->updateOrderStatus($order_id, 'deny');
        } else if ($transaction == 'expire') {
            $this->updateOrderStatus($order_id, 'expire');
        } else if ($transaction == 'cancel') {
            $this->updateOrderStatus($order_id, 'cancel');
        }

        http_response_code(200);
    }

    private function updateOrderStatus($order_id, $status)
    {
        // Implement your own logic to update order status in the database
    }
}
?>