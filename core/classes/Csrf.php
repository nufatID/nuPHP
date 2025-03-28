<?php

namespace App\core;

class Csrf
{


    public function __construct()
    {
        if (isset($_SESSION['token_login'])) {
            $authToken = $_SESSION['token_login'];

            header('Authorization: Apikey ' .  $authToken);
        } else {
            header('WWW-Authenticate: Basic realm="My Realm"');
            http_response_code(401);
        }
    }
    public static function start()
    {
        if (!isset($_SESSION['token_csrf'])) {
            $_SESSION['token_csrf'] = bin2hex(random_bytes(23));
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
        }
    }
    public static function get()
    {

        return $_SESSION['token_csrf'];
    }
    public static function BTencrypt($plaintext)
    {
        $key = self::$key;
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        $encoded_ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
        return urlencode($encoded_ciphertext); // Mengkodekan hasil enkripsi
    }

    // Fungsi untuk mendekripsi teks
    public static function BTdecrypt($ciphertext)

    {
        $key = self::$key;
        $decoded_ciphertext = urldecode($ciphertext);
        $c = base64_decode($decoded_ciphertext);
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if (hash_equals($hmac, $calcmac)) {
            return $original_plaintext;
        }
        return false;
    }

    public static function BTgenST()
    {

        if (isset($_SESSION['sesidata'])) {
            $datak = $_SESSION['sesidata'];
        } else {
            $data = bin2hex(random_bytes(23));
            $datak = self::BTencrypt($data);
            $_SESSION['sesidata'] = $datak;
        }
        return $datak;
    }
    public static function BTgenSTlo()
    {

        if (isset($_SESSION['sesidatalog'])) {
            $datak = $_SESSION['sesidatalog'];
        } else {
            $datak = self::BTencrypt($_SESSION['newlogin_noreg']);
            $_SESSION['sesidatalog'] = $datak;
        }
        return $datak;
    }
}
