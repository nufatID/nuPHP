<?php
include 'app/config.php';
class DbCheck
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;
    private $dbh;
    private $stmt;
    private $databasecek;


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
            // die($e->getMessage());
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
        $conn = mysqli_connect($this->host, $this->user, $this->pass);

        $sql = "CREATE DATABASE " . $this->db_name;
        if (mysqli_query($conn, $sql)) {
            // echo "Database created successfully";
        } else {
            // echo "Error creating database: " . mysqli_error($conn);
        }

        mysqli_close($conn);

        return shell_exec('php nu dbcheck');;
    }
}
