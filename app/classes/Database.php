<?php
class Database extends pagination
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;
    private $dbh;
    private $stmt;
    public $perPage = 10;
    public $total_pages;
    public $databasecek;
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->databasecek = 'Tidak terhubung';
            die($e->getMessage());
        }
    }
    public function query($q)
    {
        $this->stmt = $this->dbh->prepare($q);
    }
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    //dbArtibute
    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    //CreateDB start
    public function AddDAta($data)
    {
        $list = "' '";
        foreach ($data as $key => $val) {
            $list .=  ", :" . $key;
        }

        $q = " INSERT INTO $this->table VALUES  ( $list )  ";
        $this->query($q);
        foreach ($data as $key => $val) {
            $this->bind($key, $val);
        }

        $this->execute();
        return $this->RowCount();
    }
    //Ubah CreateDB start
    public function EditDAta($data, $id)
    {
        $list = "";
        foreach ($data as $key => $val) {
            $list .=  $key . " = '" . $val . "', ";
        }
        $der = substr($list, 0, -2);
        $q = " UPDATE $this->table SET $der   WHERE id=:id ";
        $this->query($q);
        // echo $q;

        $this->bind('id', $id);
        $this->execute();
        return $this->RowCount();
    }
    //ReadDatabase start
    public function getAll()
    {
        $this->query('SELECT * FROM ' . $this->table);
        return $this->resultSet();
    }

    public function getbyId($id)
    {
        $this->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->bind('id', $id);
        return $this->single();
    }
    //DElete 
    public function DeleteData($id)
    {
        $this->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->bind('id', $id);
        $this->execute();
        return $this->RowCount();
    }
    //pagination start
    public function jumlah()
    {
        $this->query('SELECT count(*) FROM ' . $this->table);
        $this->execute();
        return $this->stmt->fetchColumn();
    }

    public function halaman()
    {
        $this->total_pages = ($this->total_pages == null) ? ceil($this->jumlah() / 10) : $this->total_pages;
        return $this->total_pages;
    }
    public function CekNumeric()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = (is_numeric($page)) ? $page : 1;
        return $page;
    }
    public function pagination()
    {

        $page = $this->CekNumeric();
        $page = ($page > $this->halaman()) ? 1 : $page;
        $starting_limit = ($page - 1) * $this->perPage;
        $this->query("SELECT * FROM $this->table ORDER BY id ASC LIMIT $starting_limit,$this->perPage");
        return $this->resultSet();
    }

    public function set_pagination($p)
    {
        $this->perPage = $p;
        $this->total_pages = ceil($this->jumlah() / $p);
    }

    public function no()
    {
        return (($this->CekNumeric() - 1) * $this->perPage) + 1;
    }
    //pagination end
    public function RowCount()
    {
        $this->stmt->rowCount();
    }
}
