<?php

class Test extends Controller
{
    public function index($p1, $p2, $p3)
    {
        $data['data'] = $this->model('UserModel');
        $data['param'] = $p1;
        Cetak('new/index', $data);
    }
}
