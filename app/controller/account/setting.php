<?php

use App\Core\Controller;
use App\Model\User;
use App\Core\Email;

class setting extends Controller
{
    public $auth = true;

    public function index()
    {
        $user["user"] = User::find($_SESSION['login']);
        View("profil/akunsett", $user);
    }

    public function updatePassword()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['new_password_confirmation'];

        if ($new_password !== $confirm_password) {
            $_SESSION['error_update_password'] = 'Password baru dan konfirmasi password tidak cocok.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $user = User::find($_SESSION['login']);
        if (!password_verify($current_password, $user->password_hash)) {
            $_SESSION['error_update_password'] = 'Password lama salah.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $options = ['cost' => 10];
        $user->password_hash = password_hash($new_password, PASSWORD_BCRYPT, $options);
        $user->save();

        $_SESSION['status_update_password'] = 'Password berhasil diubah.';
        header('Location: ' . getBaseUrl() . 'account/setting');
        exit();
    }

    public function updateEmail()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $new_email = $_POST['new_email'];
        $user = User::find($_SESSION['login']);

        if (!$user || $user->email === $new_email) {
            $_SESSION['error_update_email'] = 'Email sudah digunakan.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        // Generate activation token
        $token = bin2hex(random_bytes(32));
        $user->email = $new_email;
        $user->active_email = 0;
        $user->activation_token = $token;
        $user->save();

        // Send activation email
        $activation_link = getBaseUrl() . "account/activateEmail?token=" . $token;
        $subject = "Aktivasi Email Baru Anda";
        $message = "Klik link berikut untuk mengaktifkan email Anda: " . $activation_link;

        $email = new Email();
        $emailSent = $email->sendMail($new_email, $subject, $message);

        if ($emailSent) {
            $_SESSION['status_update_email'] = 'Email berhasil diubah. Silakan cek email Anda untuk mengaktifkan email baru.';
        } else {
            $_SESSION['error_update_email'] = 'Gagal mengirim email aktivasi.';
        }

        header('Location: ' . getBaseUrl() . 'account/setting');
        exit();
    }

    public function activateEmail()
    {
        if (!isset($_GET['token'])) {
            $_SESSION['error_update_email'] = 'Token aktivasi tidak valid.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $token = $_GET['token'];
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            $_SESSION['error_update_email'] = 'Token aktivasi tidak valid.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $user->active_email = 1;
        $user->activation_token = null;
        $user->save();

        $_SESSION['status_update_email'] = 'Email Anda telah berhasil diaktifkan.';
        header('Location: ' . getBaseUrl() . 'account/setting');
        exit();
    }
}
