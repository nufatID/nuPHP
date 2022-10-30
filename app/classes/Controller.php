<?php
class Controller
{
    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }
}
