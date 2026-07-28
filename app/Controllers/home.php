<?php

use App\Core\Controller;

class home extends Controller
{
    public function index()
    {
        last_form();
        View("welcome", [
            'title' => 'Selamat Datang di nuPHP Framework v2.0'
        ]);
    }
}
