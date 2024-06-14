<?php

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
    $theme = new SimpleTemplateEngine\Environment('views');
    echo $theme->render($file . '.php', $data);
}
function CetakInit($file)
{

    $modelna = new index();
    $modelna->set($file);
    $theme = new SimpleTemplateEngine\Environment('views');
    $data['data'] = $modelna;
    $data['old']  = Oldata::get();
    echo $theme->render($file . '.php', $data);
}
function CetakInitf($file, $folder, $p1 = null, $p2 = null, $p3 = null)
{
    $modelna = new index();
    $modelna->set($folder);
    $theme = new SimpleTemplateEngine\Environment('views');
    $data['data'] = $modelna;
    $data['p1'] = $p1;
    $data['p2'] = $p2;
    $data['p3'] = $p3;
    $data['get']  = $_GET;
    $data['old']  = Oldata::get();
    echo $theme->render($folder . '/' . $file . '.php', $data);
}

function response($status,  $data)
{
    header("Content-Type:application/json");
    header("HTTP/1.1 " . $status);
    $response['data'] = $data;
    $json_response = json_encode($data);
    echo $data;
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
