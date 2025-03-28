<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

// Definisikan variabel untuk jalur root proyek
$rootDir = __DIR__ . '/..';

// Require autoload, konfigurasi, dan file loader dari root direktori
require_once $rootDir . '/vendor/autoload.php';
require_once $rootDir . '/core/config.php';
require_once $rootDir . '/loader.php';
require_once $rootDir . '/Routes.php';
