<?php

function generateUID($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function isLogin()
{
    if (isset($_SESSION['login'])) {
        return true;
    }
}
function isRole($v)
{
    // Pastikan $_SESSION['login_role'] sudah di-set
    if (isset($_SESSION['login_role'])) {
        // Jika $v adalah array
        if (is_array($v)) {
            if (in_array($_SESSION['login_role'], $v)) {
                return true;
            } else {
                return false;
            }
        } else { // Jika $v adalah nilai tunggal
            if ($_SESSION['login_role'] == $v) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        // Jika $_SESSION['login_role'] belum di-set, kembalikan false
        return false;
    }
}
