<?php

use App\Core\Oldata;

function now()
{
    return date('Y-m-d H:i:s');
}

function getBaseUrl()
{
    $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = $scheme . '://' . $host . '/';
    return $baseUrl;
}
function getVersion()
{
    return NUPHP;
}
function getAppVersion()
{
    return APP_VERSION;
}
function View($file, $data = [])
{
    $theme = new \Nufat\Nutemplete\Render(__DIR__ . '/../views');
    echo $theme->render($file . '.nu.php', $data);
}
function Element($file, $data = [])
{
    // Naik satu folder dari direktori saat ini
    $parentDir = dirname(__DIR__);
    $theme = new \Nufat\Nutemplete\Render($parentDir . '/resource/element');
    echo $theme->render($file . '.nu.php', $data);
}
function response($status, $data)
{
    header("Content-Type: application/json");
    http_response_code($status);
    echo json_encode(['data' => $data]);
}

function res($status, $data)
{
    header("Content-Type: application/json");
    http_response_code($status);
    echo json_encode(['data' => $data]);
}

function textToSlug($text = '')
{
    $text = trim($text);
    if (empty($text)) return '';
    $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
    $text = strtolower(trim($text));
    $text = str_replace(' ', '-', $text);
    $text = $text_ori = preg_replace('/\-{2,}/', '-', $text);
    return $text;
}
