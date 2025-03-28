<?php

namespace Nufat\Cli;

class CliHandler
{
    public function handle($argv)
    {
        if (isset($argv[1])) {
            switch ($argv[1]) {
                case "serve":
                    $port = isset($argv[2]) ? $argv[2] : 8005;
                    $server = new Server();
                    return $server->start($port);
                case "serve2":
                    $port = isset($argv[2]) ? $argv[2] : 8006;
                    $server = new Server();
                    return $server->start($port);
                case "serve3":
                    $port = isset($argv[2]) ? $argv[2] : 8007;
                    $server = new Server();
                    return $server->start($port);
                case "servedb":
                    $port = isset($argv[2]) ? $argv[2] : 8008;
                    $server = new Server();
                    return $server->start($port, 'core/database');
                case "buat":
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
}
