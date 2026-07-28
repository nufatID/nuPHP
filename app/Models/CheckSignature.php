<?php

namespace App\Models;


class CheckSignature
{
    public static function isValidSignature($payload)
    {

        $serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $inputSignature = $payload['signature_key'];

        $mySignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $inputSignature === $mySignature;
    }
}
