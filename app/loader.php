<?php

use Jenssegers\Blade\Blade;


spl_autoload_register(function ($class) {
    include  __DIR__ . '/classes/' . $class . '.php';
});

require_once(__DIR__ . '/index.php');
require_once('core/Block.php');
require_once('core/Template.php');
require_once('core/Environment.php');
require_once('core/functional.php');
require_once(__DIR__ . '/Connection.php');

function Views($file, $data = [])
{
    $views = __DIR__ . '/views'; // Direktori untuk file template blade
    $cache = __DIR__ . '/cache'; // Direktori untuk file cache blade
    $blade = new Blade($views, $cache);
    echo $blade->make($file, $data);
}



Csrf::start();
function Init($file,  $parms = null)
{

    if (file_exists('app/controller/' . $file . '.php')) {
        require_once('controller/' . $file . '.php');
        if (class_exists($file)) {
            $file = new $file;
            if (method_exists($file, 'index')) {
                call_user_func_array(array($file, "index"), array($file));
            }
        }
    } elseif (file_exists('views/' . $file . '.php')) {
        CetakInit($file);
    } else {
        header('HTTP/1.0 404 Not Found');
        View('404');
    }
}
function InitFolder($file, $folder, $p1 = null, $p2 = null, $p3 = null)
{

    if (file_exists('app/controller/' . $folder . '.php')) {
        require_once('controller/' . $folder . '.php');
        if (class_exists($folder)) {
            $folder = new $folder;
            if (method_exists($folder, $file)) {
                $file = $file;
            } elseif (method_exists($folder, 'index')) {
                $file = 'index';
            } else {
                header('HTTP/1.0 404 Not Found');
                View('404');
            }
            call_user_func_array(array($folder, $file), array($p1, $p2, $p3));
        }
    } elseif (file_exists('views/' . $folder . '/' . $file . '.php')) {
        CetakInitf($file, $folder, $p1, $p2, $p3);
    } else {
        header('HTTP/1.0 404 Not Found');
        View('404');
    }
}
