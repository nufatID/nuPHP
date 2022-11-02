<?php
include 'app/config.php';
class DbCheck
{
    protected $host = DB_HOST;
    protected $user = DB_USER;
    protected $pass = DB_PASS;
    protected $db_name = DB_NAME;
    protected $dbh;
    protected $stmt;
    protected $databasecek;
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
            $this->databasecek = $e->getMessage();
        }
    }
    public function Index()
    {

        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'Database check : ' . "\n";
        if (isset($this->databasecek)) {
            $y .= $this->databasecek . "\n";
            $y .= 'silahkan check di app/config.php untuk setting koneksi ke database ' . "\n";
            $y .= 'atau ketik perintah ' . "\n";
            $y .= 'php nu dbcheck fix' . "\n";
        } else {
            $y .= 'Database oke sudah terhubung ' . "\n";
        }

        $y .= '---------------------------------------------------' . "\n";
        return $y;
    }
    public function fix()
    {
        if (isset($this->databasecek)) {
            $conn = mysqli_connect($this->host, $this->user, $this->pass);
            $sql = "CREATE DATABASE " . $this->db_name;
            if (mysqli_query($conn, $sql)) {
                return shell_exec('php nu dbcheck');
            }
            mysqli_close($conn);
        } else {
            return shell_exec('php nu dbcheck');
        }
    }
}
