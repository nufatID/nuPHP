<?php

use App\Model\User;


class Auth
{
    public $auth = AUTH;
    public function __construct($re = null)
    {

        if (isset($_POST['auth_login']) && $_POST['auth_login'] == $_SESSION['token_csrf']) {
            $this->login($_POST["username"], $_POST['password']);
            exit();
        }

        $this->auth = (isset($re)) ?  $re : $this->auth;
        ($this->auth) ? $this->checklog() : '';
    }



    private function checklog()
    {
        if (!isset($_SESSION['login'])) {
            $this->auth = false;
            header("location: " . getBaseUrl() . "auth/login");
            exit();
        } else {
            $this->checktoken();
        }
    }


    public function checkToken()
    {
        $user = user::where('token', $_SESSION['token_login'])->first();
        if (!$user) {
            unset($_SESSION['login']);
            header("location: " . getBaseUrl());
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
        setcookie('token_login', '', time() - 3600, "/");

        header("location: " . getBaseUrl());
    }


    public function login($emailOrUsername, $password)
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
            $_COOKIE['token_login'] = $token;
            $this->recordLog($token, $user->id);

            if (isset($_SESSION['oldpage'])) {
                header("Location: " . $_SESSION['oldpage']);
            } else {
                header("location: " . getBaseUrl());
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
        header("location: " . getBaseUrl() . "auth/login?back");
        exit();
    }
    public function backtoR()
    {
        $data['err'] = Alert::SetAlert('danger', 'Username atau Password Salah...!!!');
        Oldata::set();
        header("location: " . getBaseUrl() . "auth/login");
        exit();
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['login'])) {

            return true;
        }
    }
}
