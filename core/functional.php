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
function response($data = [], $status = 200)
{
    if (is_numeric($data) && !empty($status)) {
        $swap = $status;
        $status = $data;
        $data = $swap;
    }
    header("Content-Type: application/json");
    http_response_code($status);
    echo json_encode(is_array($data) ? $data : ['data' => $data], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

function res($status, $data)
{
    return response($data, $status);
}

function request($key = null, $default = null)
{
    if ($key === null) {
        return array_merge($_GET, $_POST);
    }
    return $_REQUEST[$key] ?? $_POST[$key] ?? $_GET[$key] ?? $default;
}

function redirect($url)
{
    $baseUrl = function_exists('getBaseUrl') ? getBaseUrl() : '';
    if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
        $url = rtrim($baseUrl, '/') . '/' . ltrim($url, '/');
    }
    header('Location: ' . $url);
    exit;
}

function session($key = null, $default = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($key === null) {
        return $_SESSION;
    }
    if (is_array($key)) {
        foreach ($key as $k => $v) {
            $_SESSION[$k] = $v;
        }
        return true;
    }
    return $_SESSION[$key] ?? $default;
}

function env($key, $default = null)
{
    return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?: $default;
}

function db()
{
    if (class_exists('\Illuminate\Database\Capsule\Manager')) {
        return \Illuminate\Database\Capsule\Manager::class;
    }
    return null;
}

function validator(array $data, array $rules)
{
    return \App\Core\Validator::make($data, $rules);
}

function session_flash($key, $value = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return $value;
    }
    $val = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $val;
}

function flash($key = null)
{
    if ($key === null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $flashes = $_SESSION['_flash'] ?? [];
        unset($_SESSION['_flash']);
        return $flashes;
    }
    return session_flash($key);
}

function middleware(string|array $names)
{
    return \App\Core\Middleware::run($names);
}

function resource(mixed $data, ?callable $callback = null)
{
    if (is_iterable($data) && !is_array($data) && !($data instanceof \Illuminate\Support\Collection)) {
        return \App\Core\Resource::collection($data, $callback);
    }
    return \App\Core\Resource::make($data, $callback);
}

function textToSlug($text = '')
{
    $text = trim($text);
    if (empty($text)) return '';
    $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
    $text = strtolower(trim($text));
    $text = str_replace(' ', '-', $text);
    $text = preg_replace('/\-{2,}/', '-', $text);
    return $text;
}
