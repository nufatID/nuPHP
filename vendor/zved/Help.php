<?php
class Help
{
    public static function Index()
    {
        $y = '--------------------------------------------' . "\n";
        $y .= '
                  $$$$$$$\ $$\   $$\$$$$$$$\  
                  $$  __$$\$$ |  $$ $$  __$$\ 
$$$$$$$\ $$\   $$\$$ |  $$ $$ |  $$ $$ |  $$ |
$$  __$$\$$ |  $$ $$$$$$$  $$$$$$$$ $$$$$$$  |
$$ |  $$ $$ |  $$ $$  ____/$$  __$$ $$  ____/ 
$$ |  $$ $$ |  $$ $$ |     $$ |  $$ $$ |      
$$ |  $$ \$$$$$$  $$ |     $$ |  $$ $$ |      
\__|  \__|\______/\__|     \__|  \__\__|      
                                                                                             
';
        $y .= '--------------------------------------------' . "\n";
        $y .= 'daftar command yang tersedia untuk nuphp :' . "\n";
        $y .= '--------------------------------------------' . "\n";
        $y .= '| php nu serve |---> untuk run server' . "\n";
        $y .= '| php nu buat metode namafile |---> untuk buat file' . "\n";
        $y .= '| php nu dbcheck |---> untuk cek koneksi database' . "\n";
        $y .= '| php nu dbcheck fix |---> untuk membuat database' . "\n";
        $y .= '| php nu auth |---> untuk check sytem auth' . "\n";
        $y .= '| php nu auth sett |---> untuk setting table auth ' . "\n";
        $y .= '' . "\n";
        $y .= 'silahkan coba perintah diatas' . "\n";
        $y .= '' . "\n";

        return $y;
    }
    public static function Buat($method)
    {
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'methode ' . $method . ' tidak ada ...!!!' . "\n";
        $y .= 'silahkan masukan nama metode :' . "\n";
        $y .= ' m | model  --> untuk membuat model' . "\n";
        $y .= ' v | view  --> untuk membuat view' . "\n";
        $y .= ' c | controller  --> untuk membuat controller' . "\n";
        $y .= ' t | table  --> untuk membuat tabel database' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= ' contoh : php nu buat cont namaControler m v t' . "\n";
        $y .= ' perintah akan membuat controler, model, view, dan table secara otomatis' . "\n";
        $y .= '' . "\n";
        $y .= ' contoh : php nu buat cont namaControler m v' . "\n";
        $y .= ' perintah akan membuat controler, model, dan view secara otomatis' . "\n";
        $y .= '' . "\n";
        $y .= ' contoh : php nu buat cont namaControler m' . "\n";
        $y .= ' perintah akan membuat controler dan model secara otomatis' . "\n";
        $y .= '' . "\n";
        $y .= ' contoh : php nu buat cont namaControler' . "\n";
        $y .= ' perintah akan membuat controler secara otomatis' . "\n";
        $y .= '' . "\n";
        return $y;
    }
    public static function Buatco()
    {
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'silahkan masukan namanya' . "\n";
        $y .= 'contoh : php nu buat cont namanya' . "\n";
        $y .= 'contoh : php nu buat view namanya' . "\n";
        $y .= 'contoh : php nu buat model namanya' . "\n";
        $y .= 'contoh : php nu buat tabel namanya' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        return $y;
    }
    public static function onp()
    {
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'Maaf Fungsi masih dalam progress' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        return $y;
    }
}
