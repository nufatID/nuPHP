<?php

namespace App\Core;

use App\Model\User;

class Auth
{
    public $auth = AUTH;

    public function __construct($re = null)
    {
        if (isset($_POST['auth_login']) && $_POST['auth_login'] == $_SESSION['token_csrf']) {
            $remember = isset($_POST['remember']) ? true : false;
            $this->login($_POST["username"], $_POST['password'], $remember);
            exit();
        }

        // Auto-login
        if (!isset($_SESSION['login']) && isset($_COOKIE['token_login'])) {
            $user = User::where('token', $_COOKIE['token_login'])->first();
            if ($user) {
                $_SESSION['login'] = $user->id;
                $_SESSION['login_member'] = $user->member_id;
                $_SESSION['login_noreg'] = $user->noreg;
                $_SESSION['login_role'] = $user->role;
                $_SESSION['token_login'] = $_COOKIE['token_login'];
                $this->recordLog($_COOKIE['token_login'], $user->id);
            }
        }

        $this->auth = (isset($re)) ? $re : $this->auth;
        ($this->auth) ? $this->checklog() : '';
    }

    private function checklog()
    {
        if (!isset($_SESSION['login'])) {
            $this->auth = false;
            header("Location: " . getBaseUrl() . "auth/login");
            exit();
        } else {
            $this->checkToken();
        }
    }

    public function checkToken()
    {
        $token = $_SESSION['token_login'] ?? $_COOKIE['token_login'] ?? null;
        $user = User::where('token', $token)->first();
        if (!$user) {
            unset($_SESSION['login']);
            setcookie('token_login', '', time() - 3600, "/"); // Hapus cookie jika token tidak valid
            header("Location: " . getBaseUrl());
        }
    }

    public function Password($p)
    {
        $options = [
            'cost' => 10,
        ];
        return password_hash($p, PASSWORD_BCRYPT, $options);
    }

    public function logout()
    {
        unset($_SESSION['login']);
        session_unset();
        session_destroy();
        setcookie('token_login', '', time() - 3600, "/"); // Hapus cookie

        header("Location: " . getBaseUrl());
    }

    public function login($emailOrUsername, $password, $remember = false)
    {
        $user = User::where('email', $emailOrUsername)
            ->orWhere('username', $emailOrUsername)
            ->first();

        if ($user && password_verify($password, $user->password_hash)) {
            $token = bin2hex(random_bytes(17));
            $_SESSION['login'] = $user->id;
            $_SESSION['login_member'] = $user->member_id;
            $_SESSION['login_noreg'] = $user->noreg;
            $_SESSION['login_role'] = $user->role;
            $_SESSION['token_login'] = $token;

            if ($remember) {
                setcookie('token_login', $token, time() + (86400 * 30), "/"); // 30 days
            } else {
                setcookie('token_login', '', time() - 3600, "/"); // Hapus cookie jika tidak diingat
            }

            $this->recordLog($token, $user->id);

            if (isset($_SESSION['oldpage'])) {
                header("Location: " . $_SESSION['oldpage']);
            } else {
                header("Location: " . getBaseUrl());
            }
            exit();
        } else {
            $this->backto();
        }
    }

    private function recordLog($token, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->token = $token;
            $user->updated_at = now(); // Use Laravel's now() helper to get the current date and time
            $user->save();
        }
    }

    public function backto()
    {
        $data['err'] = Alert::SetAlert('danger', 'Username atau Password Salah...!!!');
        Oldata::set();
        header("Location: " . getBaseUrl() . "auth/login?back");
        exit();
    }

    public function backtoR()
    {
        $data['err'] = Alert::SetAlert('danger', 'Username atau Password Salah...!!!');
        Oldata::set();
        header("Location: " . getBaseUrl() . "auth/login");
        exit();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['login']);
    }
}