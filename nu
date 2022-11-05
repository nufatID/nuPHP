#!/usr/bin/php php
<?php
require_once 'vendor/zved/Help.php';
print_r(run($argv));
function  run($argv)
{
    if (isset($argv[1])) {
        switch ($argv[1]) {
            case "serve":
                shell_exec('php -S localhost:8005 -t .');
                break;
            case "buat":
                return Help::onp();
                exit();
                require_once 'vendor/zved/Buat.php';
                $buat = new Buat;
                $method = (isset($argv[2])) ? $argv[2] : 'error atau';
                $nama = (isset($argv[3])) ? $argv[3] : 'err';
                $p1 = (isset($argv[4])) ? $argv[4] : null;
                $p2 = (isset($argv[5])) ? $argv[5] : null;
                $p3 = (isset($argv[6])) ? $argv[6] : null;
                $p4 = (isset($argv[7])) ? $argv[7] : null;

                if (method_exists($buat, $method)) {
                    if ($nama != 'err') {
                        return $buat->index($method, $nama, $p1, $p2, $p3, $p4);
                    } else {
                        return Help::buatco();
                    }
                } else {
                    return Help::buat($method);
                }
                break;

            case "serve2":
                return shell_exec('php -S localhost:8006 -t .');
                break;
            case "serve3":
                return shell_exec('php -S localhost:8007 -t .');
                break;
            default:
                if (file_exists('vendor/zved/' . $argv[1] . '.php')) {
                    if ($argv[1] != 'help') {
                        require_once 'vendor/zved/' . $argv[1] . '.php';
                    }
                    $ble = new $argv[1];
                    if (isset($argv[2])) {
                        $bk = $argv[2];
                        return $ble->$bk();
                    } else {

                        return $ble->index();
                    }
                } else {
                    return Help::Index();
                }
        }
    } else {
        return Help::Index();
    }
}
