<?php

namespace Nufat\Cli;

use Nufat\Cli\DbCheck;

class Auth extends DbCheck
{
    public function Index()
    {
        // Gunakan namespace global untuk mysqli
        $conn = new \mysqli($this->host, $this->user, $this->pass, $this->db_name);

        // query 
        $exists = mysqli_query($conn, "SELECT 1 FROM users LIMIT 0");

        // check it exists
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        if ($exists) {
            $y .= 'AUTH successs !!! table auth sudah dibuatkan ke database' . "\n";
            $y .= '---------------------------------------------------' . "\n";
            $y .= '' . "\n";
            $y .= 'system auth anda sudah bisa digunakan' . "\n";
        } else {
            $y .= 'AUTH BELUM TERSETTING !!!' . "\n";
            $y .= '---------------------------------------------------' . "\n";
            $y .= '' . "\n";
            $y .= 'silahkan ketik perintah' . "\n";
            $y .= 'php nu auth sett' . "\n";
        }
        $y .= '' . "\n";

        return $y;
    }

    public function sett()
    {
        // Gunakan namespace global untuk mysqli
        $conn = new \mysqli($this->host, $this->user, $this->pass, $this->db_name);
        $query = '';

        // Menentukan jalur relatif ke db.sql
        $sqlScriptPath = __DIR__ . '/db.sql';
        if (!file_exists($sqlScriptPath)) {
            echo "File SQL tidak ditemukan di jalur $sqlScriptPath";
            exit(1);
        }

        $sqlScript = file($sqlScriptPath);
        foreach ($sqlScript as $line) {

            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);

            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }

            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($conn, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
                $query = '';
            }
        }
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'success !!! table auth sudah dibuatkan ke database' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= '' . "\n";
        $y .= 'system auth anda sudah bisa digunakan' . "\n";
        $y .= '' . "\n";

        return $y;
    }
}
