<?php
class Index extends Database
{
    public $table;
    public function set($na)
    {
        $this->table = $na;
    }
}

class Controller
{
    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }
}
