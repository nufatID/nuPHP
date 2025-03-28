<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
    'prefix' => '',
]);
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'bunp2332_wp812',
    'username' => 'bunp2332_wp812',
    'password' => '6USS[!5f4p',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci', // tambahkan collation untuk menghindari masalah karakter
    'prefix' => 'wpw6_',
], 'mysqlwordpress'); // Nama koneksi

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'bunp2332_auth',
    'username' => 'DB_USER_KTA',
    'password' => 'DB_PASS_KTA',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci', // tambahkan collation untuk menghindari masalah karakter
], 'auth'); // Nama koneksi


$capsule->setAsGlobal();
$capsule->bootEloquent();
//$capsule->table('imgclamps')->truncate();