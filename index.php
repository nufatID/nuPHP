<?php
session_start();
$_SESSION['token'] = bin2hex(random_bytes(17));
$_SESSION['token2'] = md5(uniqid(mt_rand(), true));
require_once __DIR__ . '/vendor/autoload.php';
require_once('app/config.php');
require 'app/loader.php';
require 'app/Routes.php';
