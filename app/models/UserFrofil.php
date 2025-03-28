<?php

namespace App\Model;

use App\Model\member;


class UserFrofil
{
    static public function gambar()
    {
        $login = member::find($_SESSION['login_member'])->first();
        return $login->gambar;
    }
}
