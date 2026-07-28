<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$driver = DB_DRIVER;

if ($driver === 'sqlite') {
    $sqlitePath = env('DB_DATABASE', __DIR__ . '/database/database.sqlite');
    $capsule->addConnection([
        'driver'   => 'sqlite',
        'database' => $sqlitePath,
        'prefix'   => '',
    ]);
} else {
    $capsule->addConnection([
        'driver'    => DB_DRIVER,
        'host'      => DB_HOST,
        'port'      => DB_PORT,
        'database'  => DB_NAME,
        'username'  => DB_USER,
        'password'  => DB_PASS,
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
    ]);
}

$capsule->setAsGlobal();
$capsule->bootEloquent();