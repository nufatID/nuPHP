<?php

namespace App\Core;

class Oldata
{
    private $data;
    public static function set()
    {
        $_SESSION['oldata'] = $_POST;
    }
    public static function get()
    {
        if (isset($_SESSION['oldata'])) {
            $data = $_SESSION['oldata'];
            unset($_SESSION['oldata']);
            return $data;
        }
    }
}
