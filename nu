#!/usr/bin/php
<?php

require 'vendor/autoload.php';

use Nufat\Cli\Buat;
use Nufat\Cli\Help;

print_r(run($argv));

function run($argv)
{
    if (isset($argv[1])) {
        switch ($argv[1]) {
            case "serve":
                shell_exec('php -S localhost:8005 -t .');
                break;
            case "buat":
                $buat = new Buat();
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
            case "b":
                $buat = new Buat();
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
                if (class_exists('Nufat\\Cli\\' . ucfirst($argv[1]))) {
                    $classname = 'Nufat\\Cli\\' . ucfirst($argv[1]);
                    $ble = new $classname();
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
