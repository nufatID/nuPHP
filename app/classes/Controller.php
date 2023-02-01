<?php
class Controller
{

    public function __construct()
    {
        if (isset($this->auth)) {
            $this->auth($this->auth);
        }
    }
    protected function auth($by)
    {
        $auth = new Auth($by);
    }
    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }
    public function cont($m)
    {
        require_once 'app/controller/' . $m . '.php';
        return new $m;
    }
}
