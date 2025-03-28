<?php

namespace App\Core;

use App\Model\Apikey;
use App\Core\Auth;

class Controller
{
    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $_SESSION['oldpage'] = $_SERVER['REQUEST_URI'];
        }
        if (isset($this->auth)) {
            $this->auth($this->auth);
        }
        if (isset($this->role)) {
            $this->roles($this->role);
        }
    }

    protected function auth($by)
    {
        $auth = new Auth($by);
    }

    public function roles($v)
    {
        if (!isset($_SESSION['login_role'])) {
            header("location: " . getBaseUrl());
            exit();
        }
        if (is_array($v)) {
            if (!in_array($_SESSION['login_role'], $v)) {
                header("location: " . getBaseUrl());
                exit();
            }
        } else {
            if ($_SESSION['login_role'] != $v) {
                header("location: " . getBaseUrl());
                exit();
            }
        }
    }

    public function cekpost()
    {
        $last = get_last_form();
        if (!$this->checkCsrf($_POST['csrf'])) {
            if (isset($last)) {
                header("Location: " . $last . "?error=csrf");
            } else {
                header("location: " . getBaseUrl() . "?error=csrf");
            }
            exit;
        }
    }

    public function cekjekpost()
    {
        $jenis = $_POST['type'];
        $all = ['kredit', 'debit'];
        if (!in_array($jenis, $all)) {
            header("location: " . getBaseUrl() . "kesalahan?error=jenis harus kredit atau debit");
            exit;
        }
    }

    public function checkCsrf($token)
    {
        return isset($_SESSION['token_csrf']) && $_SESSION['token_csrf'] == $token;
    }

    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }

    public function cont($m)
    {
        require_once 'app/controller/' . $m . '.php';
        return new $m;
    }

    public function res($status, $data)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function apiKEY($apiserver)
    {
        $apikey = isset($_SERVER["HTTP_APIKEY"]) ? $_SERVER["HTTP_APIKEY"] : null;
        if ($apikey === null || empty($apikey)) {
            $data["msg"] = "API key diperlukan";
            $this->res(401, $data);
            exit();
        }
        if ($apikey !== $apiserver) {
            $data["msg"] = "API key tidak valid";
            $this->res(403, $data);
            exit();
        }
    }

    public function APIKeys()
    {
        $apikey = isset($_SERVER["HTTP_APIKEY"]) ? $_SERVER["HTTP_APIKEY"] : null;
        if ($apikey === null || empty($apikey)) {
            $data["msg"] = "API key diperlukan";
            $this->res(401, $data);
            exit();
        }
        $apiKeyFromDb = Apikey::where('apikey', $apikey)->first();
        if (!$apiKeyFromDb) {
            $data["msg"] = "API key tidak valid";
            $this->res(403, $data);
            exit();
        }
    }
}
