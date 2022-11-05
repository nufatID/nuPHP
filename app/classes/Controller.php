<?php
class Controller
{
    public function __construct()
    {
        $auth = new Auth;
    }
    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }
}
