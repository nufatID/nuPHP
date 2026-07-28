<?php

namespace App\Models;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

class MidtransModel
{
    public function __construct()
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
    }
}
