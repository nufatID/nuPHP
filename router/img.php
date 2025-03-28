<?php

class img
{
    public function qrcode($text = "https://bungtemin.net")
    {

        $size = 12; // Ukuran gambar QR code
        $errorCorrectionLevel = "L"; // Level koreksi kesalahan (L, M, Q, H)
        $margin = 1; // Margin di sekeliling QR code
        $moduleSize = 1; // Ukuran modul QR code

        // Menggunakan nilai default jika $text kosong
        $text = empty($text) ? "https://bungtemin.net" : $text;

        QRcode::png(
            $text,
            false,
            $errorCorrectionLevel,
            $size,
            $margin,
            false,
            0xffffff,
            0x000000,
            $moduleSize
        );
    }
    public function textcode()
    {


        $encodedUrl = $_GET['text'];
        $text = decodeUrl($encodedUrl);
        $size = 12; // Ukuran gambar QR code
        $errorCorrectionLevel = "L"; // Level koreksi kesalahan (L, M, Q, H)
        $margin = 1; // Margin di sekeliling QR code
        $moduleSize = 1; // Ukuran modul QR code

        // Menggunakan nilai default jika $text kosong
        $text = empty($text) ? "https://bungtemin.net" : $text;

        QRcode::png(
            $text,
            false,
            $errorCorrectionLevel,
            $size,
            $margin,
            false,
            0xffffff,
            0x000000,
            $moduleSize
        );
    }
}
