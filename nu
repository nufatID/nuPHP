#!/usr/bin/php php
<?php

print_r(run($argv));
function  run($argv)
{
    switch ($argv[1]) {
        case "serve":
            shell_exec('php -S localhost:8005 -t .');
            break;
        case "buat":
            require_once 'zved/Buat.php';
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
            require_once 'zved/Bikin.php';
            $ble = new Bikin;
            $p = (isset($argv[2])) ? $argv[2] : 'err';
            $p1 = (isset($argv[3])) ? $argv[3] : null;
            $p2 = (isset($argv[4])) ? $argv[4] : null;
            if ($p != 'err') {
                return $ble->index($p, $p1, $p2);
            } else {
                $y = '' . "\n";
                $y .= '---------------------------------------------------' . "\n";
                $y .= 'silahkan masukan nama view :' . "\n";
                $y .= 'php nu bikin namafile    ---> untuk buat file view' . "\n";
                $y .= '---------------------------------------------------' . "\n";
                return $y;
            }
            break;
        case "serve1":
            return shell_exec('php -S localhost:8006 -t .');
            break;
        case "serve2":
            return shell_exec('php -S localhost:8007 -t .');
            break;
        case "serve3":
            return shell_exec('php -S localhost:8008 -t .');
            break;
        default:
            if (file_exists('zved/' . $argv[1] . '.php')) {
                require_once 'zved/' . $argv[1] . '.php';
                $ble = new $argv[1];
                return $ble->index();
            } else {
                $y = '' . "\n";
                $y .= '---------------------------------------------------' . "\n";
                $y .= 'daftar command yang tersedia untuk nuphp :' . "\n";
                $y .= '---------------------------------------------------' . "\n";
                $y .= '' . "\n";
                $y .= 'php nu serve         ---> untuk run server' . "\n";
                $y .= 'php nu buat namafile    ---> untuk buat file' . "\n";
                $y .= '' . "\n";
                $y .= '' . "\n";
                $y .= '' . "\n";
                $y .= 'silahkan coba perintah' . "\n";

                return $y;
            }
    }
}
