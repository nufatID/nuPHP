<?php

namespace App\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class WebhookWa
{

    private static $apiKey = 'Nurani110'; // Sesuaikan dengan format autentikasi yang digunakan oleh API

    public static function kirim_notifadmin($data)
    {
        $endpoint = env('WA_BOT_URL'); // Ganti dengan URL endpoint Node.js Anda
        $client = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'number',
                    'contents' => '085882620035'
                ],
                [
                    'name' => 'message',
                    'contents' => $data
                ]
            ]
        ];
        $request = new Request('POST', $endpoint);
        $res = $client->sendAsync($request, $options)->wait();
    }
}
