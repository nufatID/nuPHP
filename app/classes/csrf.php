<?php
class Csrf
{
    public static function start()
    {
        if (!isset($_SESSION['token_csrf'])) {
            $_SESSION['token_csrf'] = bin2hex(random_bytes(23));
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
        }
    }
    public static function get()
    {

        return $_SESSION['token_csrf'] = bin2hex(random_bytes(23));
    }
}
