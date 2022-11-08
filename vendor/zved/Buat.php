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
                $this->cont = true;
                $this->controller();
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
            case "controller":
                $this->cont = true;
                $this->controller();
                break;
            case "table":
                $this->table();
                break;
            default:
        }
        $yu =  ' ' . "\n";

        if ($this->cont) {
            $yu .= 'Controler telah dibuat' . "\n";
        }
        if ($this->view) {
            $yu .=   'view telah dibuat' . "\n";
        }
        if ($this->model) {
            $yu .=   $this->nama . 'Model telah dibuat' . "\n";
        }
        if ($this->table) {
            $yu .= 'Tabel database dibuat' . "\n";
        }
        return $yu;
    }
    private function checknama($too)
    {
        $this->nama = $too;
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
        $y = "<?php" . "\n";
        $y .= "class " . $this->nama . "Model extends Database" . "\n";
        $y .= "{" . "\n";
        $y .= '     protected $table = "' . $this->nama . '";' . "\n";
        $y .= "}" . "\n";
        file_put_contents('app/models/' . $this->nama . 'Model.php', $y);
    }
    public function view()
    {
        $y = '<?php $this->extend("layout/layout.php"); ?>';
        file_put_contents('views/' . $this->nama . '.php', $y);
    }
    public function viewfc()
    {
        $irectory = "views/" . $this->nama;
        if (is_dir($irectory)) {
        } else {
            mkdir("views/" . $this->nama, 0770, true);
        }
        $y = '<?php $this->extend("layout/layout.php"); ?>';
        file_put_contents('views/' . $this->nama . '/index.php', $y);
    }

    public function modelfc()
    {
        $y = "<?php" . "\n";
        $y .= "class " . $this->nama . "Model extends Database" . "\n";
        $y .= "{" . "\n";
        $y .= '     protected $table = "' . $this->nama . '";' . "\n";
        $y .= "}" . "\n";
        file_put_contents('app/models/' . $this->nama . 'Model.php', $y);
    }
    public function controller()
    {
        $y = "<?php" . "\n";
        $y .= "class $this->nama extends Controller" . "\n";
        $y .= "{" . "\n";
        $y .= "     public function index()" . "\n";
        $y .= "     {" . "\n";
        $y .= " " . "\n";
        if ($this->model) {
            $this->modelfc();
            $y .= '         $model = $this->model("' . $this->nama . 'Model");' . "\n";
            $y .= '         $data["data"] = $model;' . "\n";
            $y .= " " . "\n";
        }
        if ($this->view) {
            $this->viewfc();
            $y .= '          View("' . $this->nama . '/index", $data);' . "\n";
            $y .= " " . "\n";
        }
        $y .= "     }" . "\n";
        $y .= "}" . "\n";
        file_put_contents('app/controller/' . $this->nama . '.php', $y);
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
