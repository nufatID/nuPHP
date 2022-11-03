#!/usr/bin/php php
<?php

print_r(run($argv));
function  run($argv)
{
    if (isset($argv[1])) {
        switch ($argv[1]) {
            case "serve":
                shell_exec('php -S localhost:8005 -t .');
                break;
            case "buat":
                require_once 'vendor/zved/Buat.php';
                $ble = new Buat;
                $p = (isset($argv[2])) ? $argv[2] : 'err';
                $p1 = (isset($argv[3])) ? $argv[3] : null;
                $p2 = (isset($argv[4])) ? $argv[4] : null;
                if ($p != 'err') {
                    return $ble->index($p, $p1, $p2);
                } else {
                    $y = '' . "\n";
                    $y .= '---------------------------------------------------' . "\n";
                    $y .= 'silahkan masukan nama controller :' . "\n";
                    $y .= 'php nu buat namafile    ---> untuk buat file' . "\n";
                    $y .= '---------------------------------------------------' . "\n";
                    return $y;
                }
                break;
            case "bikin":
                require_once 'vendor/zved/Bikin.php';
                $ble = new Bikin;
                $p = (isset($argv[2])) ? $argv[2] : 'err';
                $p1 = (isset($argv[3])) ? $argv[3] : 'null';
                if (method_exists($ble, $p1)) {
                    if ($p != 'err') {
                        return $ble->index($p, $p1);
                    } else {
                        $y = '' . "\n";
                        $y .= '---------------------------------------------------' . "\n";
                        $y .= 'gagal...!!!' . "\n";
                        $y .= 'silahkan masukan nama view :' . "\n";
                        $y .= 'php nu bikin namafile methode   ---> untuk buat file view' . "\n";
                        $y .= '---------------------------------------------------' . "\n";
                        return $y;
                    }
                } else {
                    $y = '' . "\n";
                    $y .= '---------------------------------------------------' . "\n";
                    $y .= 'gagal...!!!' . "\n";
                    $y .= 'silahkan masukan nama view :' . "\n";
                    $y .= 'php nu bikin namafile methode' . "\n";
                    $y .= ' methode list --->' . "\n";
                    $y .= '           1. html' . "\n";
                    $y .= '---------------------------------------------------' . "\n";
                    return $y;
                }
                break;
            case "ksweb":
                return shell_exec('-S localhost:8006 -t .');
                break;
            case "serve2":
                return shell_exec('php -S localhost:8006 -t .');
                break;
            case "serve3":
                return shell_exec('php -S localhost:8007 -t .');
                break;
            default:
                if (file_exists('vendor/zved/' . $argv[1] . '.php')) {
                    require_once 'vendor/zved/' . $argv[1] . '.php';
                    $ble = new $argv[1];
                    if (isset($argv[2])) {
                        $bk = $argv[2];
                        return $ble->$bk();
                    } else {

                        return $ble->index();
                    }
                } else {
                    $y = '' . "\n";
                    $y .= '------------------------------------------' . "\n";
                    $y .= 'daftar command yang tersedia untuk nuphp :' . "\n";
                    $y .= '------------------------------------------' . "\n";
                    $y .= '' . "\n";
                    $y .= 'php nu serve     ---> untuk run server' . "\n";
                    $y .= 'php nu buat namafile    ---> untuk buat file' . "\n";
                    $y .= 'php nu dbcheck    ---> untuk cek koneksi database' . "\n";
                    $y .= 'php nu dbcheck fix    ---> untuk membuat database' . "\n";
                    $y .= 'php nu auth ---> untuk check sytem auth' . "\n";
                    $y .= 'php nu auth sett    ---> untuk setting table auth' . "\n";
                    $y .= '' . "\n";
                    $y .= '' . "\n";
                    $y .= '' . "\n";
                    $y .= 'silahkan coba perintah' . "\n";

                    return $y;
                }
        }
    } else {
        $y = '' . "\n";
        $y .= 'Nuphp adalah sebuah framework php' . "\n";
        $y .= 'yang memudahkan kita untuk mebuat website' . "\n";
        $y .= 'dengan bahasa pemograman php' . "\n";
        $y .= 'dengan konsep MVC maupun NonMVC' . "\n";
        $y .= 'dan juga konsep OOP atau Prosedural' . "\n";
        $y .= '' . "\n";
        $y .= '' . "\n";
        $y .= '--------------------------------------------' . "\n";
        $y .= 'daftar command yang tersedia untuk nuphp :' . "\n";
        $y .= '--------------------------------------------' . "\n";
        $y .= '| php nu serve |---> untuk run server' . "\n";
        $y .= '| php nu buat namafile |---> untuk buat file' . "\n";
        $y .= '| php nu dbcheck |---> untuk cek koneksi database' . "\n";
        $y .= '| php nu dbcheck fix |---> untuk membuat database' . "\n";
        $y .= '| php nu auth |---> untuk check sytem auth' . "\n";
        $y .= '| php nu auth sett |---> untuk setting table auth ' . "\n";
        $y .= '' . "\n";
        $y .= '' . "\n";
        $y .= '' . "\n";
        $y .= 'silahkan coba perintah diatas' . "\n";
        $y .= '' . "\n";
        $y .= '' . "\n";
        return $y;
    }
}
