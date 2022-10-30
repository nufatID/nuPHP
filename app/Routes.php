<?php

use Steampixel\Route;

define('BASEPATH', BASE_URL);

Route::add('/', function () {
    Cetak('index');
});
//kostumisasi router silahkan tambahkan disini.
//mulai kostumisasi router
Route::add('/halaman', function () {
    Cetak('home');
});


//end kostumisasi router
//Auto Router 
Route::add('/(.*)/(.*)/(.*)/(.*)/(.*)', function ($folder, $file, $p1, $p2, $p3) {
    InitFolder($file, $folder, $p1, $p2, $p3);
}, ['get', 'post']);
Route::add('/(.*)/(.*)/(.*)/(.*)', function ($folder, $file, $p1, $p2) {
    InitFolder($file, $folder, $p1, $p2);
}, ['get', 'post']);
Route::add('/(.*)/(.*)/(.*)', function ($folder, $file, $param) {
    InitFolder($file, $folder, $param);
}, ['get', 'post']);
Route::add('/(.*)/(.*)', function ($folder, $file) {
    InitFolder($file, $folder);
}, ['get', 'post']);
Route::add('/(.*)', function ($file) {
    Init($file);
}, ['get', 'post']);

//404 Router 
Route::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    Cetak('404');
});
Route::run(BASEPATH);
