<?php

class Absensi extends Controller
{
    public function index($p1, $p2 = null, $p3 = null)
    {
        $data['data'] = $this->model('UserModel');
        $data['data']->set_pagination(10);
        $data['param'] = $p1;
        View('absensi/index', $data);
    }
}
