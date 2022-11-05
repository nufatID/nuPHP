<?php

class Auth
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;
    private $dbh;
    private $stmt;
    public $auth = AUTH;
    protected $login;
    protected $table = 'users';
    public function __construct($re = null)
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($_POST['auth_login']) && $_POST['auth_login'] == $_SESSION['token_csrf']) {
            $email = $_POST['username'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->loginemail();
            } else {
                $this->login();
            }

            exit();
        }
        if (isset($_POST['auth_register']) && $_POST['auth_register'] == $_SESSION['token_csrf']) {
            $this->cekumail();
            exit();
        }
        $this->auth = (isset($re)) ?  $re : $this->auth;
        ($this->auth) ? $this->checklog() : '';
    }
    public function query($q)
    {
        $this->stmt = $this->dbh->prepare($q);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    //dbArtibute
    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
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
    public function checktoken()
    {
        $this->query('SELECT * FROM ' . $this->table . ' WHERE token=:id');
        $this->bind('id', $_SESSION['token_login']);
        if (!$this->resultSet()) {
            unset($_SESSION['login']);
            header("location: " . getBaseUrl());
        }
    }
    public function cekuserreg()
    {
        $this->query('SELECT * FROM ' . $this->table . ' WHERE username=:id');
        $this->bind('id', $_POST['username']);
        if ($this->resultSet()) {
            Alert::SetAlert('danger', 'Username sudah digunakan!!!');
            Oldata::set();
            header("location: " . getBaseUrl() . "auth/register");
            exit();
        } else {
            $this->register();
        }
    }
    public function cekumail()
    {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->query('SELECT * FROM ' . $this->table . ' WHERE email=:id');
            $this->bind('id', $_POST['email']);
            if ($this->resultSet()) {
                Alert::SetAlert('danger', 'Email sudah digunakan!!!');
                Oldata::set();
                header("location: " . getBaseUrl() . "auth/register");
                exit();
            } else {
                $this->cekuserreg();
            }
        } else {
            Alert::SetAlert('danger', 'alamat Email tidak valid!!!');
            Oldata::set();
            header("location: " . getBaseUrl() . "auth/register");
            exit();
        }
    }
    public function register()
    {
        $q = " INSERT INTO $this->table (username, email, password_hash) VALUES (:username, :email, :password_hash)";
        $this->query($q);
        $this->bind('username', $_POST['username']);
        $this->bind('email', $_POST['email']);
        $this->bind('password_hash', $this->Password($_POST['password']));
        $this->execute();
        header("location: " . getBaseUrl());
    }
    public function logout()
    {
        unset($_SESSION['login']);
        header("location: " . getBaseUrl());
    }
    private function Login()
    {
        $this->query('SELECT * FROM ' . $this->table . ' WHERE username=:id');
        $this->bind('id', $_POST["username"]);
        $d = $this->resultSet();
        if ($this->resultSet()) {
            if ($d['username'] == $_POST['username'] && password_verify($_POST['password'], $d['password_hash'])) {
                $token = bin2hex(random_bytes(17));
                $_SESSION['login'] = $d['id'];
                $_SESSION['token_login'] = $token;
                $_COOKIE['token_login'] = $token;
                $this->recordlog($token, $d['id']);
                header("location: " . getBaseUrl());
            } else {

                $this->backto();
            }
        } else {
            $this->backto();
        }
        // exit();
    }
    private function Loginemail()
    {
        $this->query('SELECT * FROM ' . $this->table . ' WHERE email=:id');
        $this->bind('id', $_POST["username"]);
        $d = $this->resultSet();
        if ($this->resultSet()) {
            if ($d['email'] == $_POST['username'] && password_verify($_POST['password'], $d['password_hash'])) {
                $token = bin2hex(random_bytes(17));
                $_SESSION['login'] = $d['id'];
                $_SESSION['token_login'] = $token;
                $_COOKIE['token_login'] = $token;
                $this->recordlog($token, $d['id']);
                header("location: " . getBaseUrl());
            } else {

                $this->backto();
            }
        } else {
            $this->backto();
        }
    }
    private function recordlog($token, $id)
    {
        $date = new DateTime();
        $q = " UPDATE $this->table SET token='$token', updated_at='{$date->format('Y-m-d H:i:s')}'   WHERE id=:id ";
        $this->query($q);
        $this->bind('id', $id);
        $this->execute();
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
    public function Password($p)
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($p, PASSWORD_BCRYPT, $options);
    }
    public function isLoggedIn()
    {
        if (isset($_SESSION['login'])) {

            return true;
        }
    }
}
