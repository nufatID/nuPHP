<?php
class Buat
{
    private $nama,
        $methode,
        $view, $table,
        $cont,
        $model,
        $folder;



    public function Index($method, $nama, $p1, $p2, $p3, $p4)
    {
        $this->checknama($nama);
        $this->methode = $method;
        $this->check($p1);
        $this->check($p2);
        $this->check($p3);
        $this->check($p4);
        switch ($method) {
            case "m":
                $this->model();
                break;
            case "v":
                $this->view();
                break;
            case "c":
                $this->cont();
                break;
            case "t":
                $this->table();
                break;
            case "model":
                $this->model();
                break;
            case "view":
                $this->view();
                break;
            case "cont":
                $this->cont();
                break;
            case "table":
                $this->table();
                break;

            default:
        }
        return 'methode     : ' . $this->methode . "\n" .
            '-- nama    : ' . $this->nama . "\n" .
            '-- contr   : ' . $this->cont . "\n" .
            '-- view    : ' . $this->view . "\n" .
            '-- model   : ' . $this->model . "\n" .
            '-- table   : ' . $this->table . '';
    }
    private function checknama($too)
    {
    }
    private function check($t)
    {
        switch ($t) {
            case "m":
                $this->model = true;
                break;
            case "v":
                $this->view = true;
                break;
            case "c":
                $this->cont = true;
                break;
            case "t":
                $this->table = true;
                break;

            default:
        }
    }
    public function model()
    {
        $this->model = 'siap dijalankan';
    }
    public function view()
    {
        $y = '<?php $this->extend("layout/layout.php"); ?>';
        file_put_contents('views/' . $this->nama . '.php', $y);
    }
    public function cont()
    {
        $this->cont = 'siap dijalankan';
    }
    public function table()
    {
        $this->table = 'siap dijalankan';
    }
    public function m()
    {
    }
    public function v()
    {
    }
    public function c()
    {
    }
    public function t()
    {
    }
}
