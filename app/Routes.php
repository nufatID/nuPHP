<?php

use Steampixel\Route;

if (!defined('BASEPATH')) {
    $base = defined('BASE_DIR') ? BASE_DIR : '/';
    define('BASEPATH', (empty($base) || str_contains($base, '/..')) ? '/' : $base);
}

/**
 * Render a View or return 404
 */
if (!function_exists('newview')) {
    function newview($path, $params = [])
    {
        $viewFile = __DIR__ . '/../views/' . $path . '.nu.php';

        if (file_exists($viewFile)) {
            View($path, $params);
        } else {
            header('HTTP/1.0 404 Not Found');
            View('404');
        }
    }
}

/**
 * Automatic Route Resolver for Controllers and Views
 */
if (!function_exists('autoloadRoute')) {
    function autoloadRoute($pathParts)
    {
        $controllerBaseDirs = [__DIR__ . '/Controllers', __DIR__ . '/controller'];
        $maxDepth = count($pathParts);

        for ($i = 0; $i < $maxDepth; $i++) {
            $currentPath = implode('/', array_slice($pathParts, 0, $i + 1));
            $nextPart = $pathParts[$i + 1] ?? null;

            foreach ($controllerBaseDirs as $controllerBaseDir) {
                // Variations of file names: path.php, PathController.php, Path.php
                $possibleFiles = [
                    $controllerBaseDir . '/' . $currentPath . '.php',
                    $controllerBaseDir . '/' . $currentPath . 'Controller.php',
                    $controllerBaseDir . '/' . dirname($currentPath) . '/' . ucfirst(basename($currentPath)) . '.php',
                    $controllerBaseDir . '/' . dirname($currentPath) . '/' . ucfirst(basename($currentPath)) . 'Controller.php',
                ];

                foreach ($possibleFiles as $controllerFilePath) {
                    if (file_exists($controllerFilePath)) {
                        require_once $controllerFilePath;

                        $baseName = ucfirst(basename($currentPath));
                        $possibleClasses = [
                            $baseName,
                            $baseName . 'Controller',
                            'App\\Controllers\\' . $baseName,
                            'App\\Controllers\\' . $baseName . 'Controller',
                        ];

                        foreach ($possibleClasses as $className) {
                            if (class_exists($className)) {
                                $controller = new $className();
                                $methodName = $nextPart ?? 'index';

                                if ($nextPart !== null && method_exists($controller, $methodName)) {
                                    $params = array_slice($pathParts, $i + 2);
                                    call_user_func_array([$controller, $methodName], $params);
                                    return;
                                } elseif (method_exists($controller, 'index')) {
                                    $params = array_slice($pathParts, $i + 1);
                                    call_user_func_array([$controller, 'index'], $params);
                                    return;
                                }
                            }
                        }
                    }
                }
            }

            // Check view directory fallback (e.g. views/about.nu.php)
            $viewPath = __DIR__ . '/../views/' . $currentPath . '.nu.php';
            if (file_exists($viewPath)) {
                $params = array_slice($pathParts, $i + 1);
                newview($currentPath, $params);
                return;
            }
        }

        // If no route matched
        header('HTTP/1.0 404 Not Found');
        View('404');
    }
}

if (!function_exists('Init')) {
    function Init($file, ...$params) {
        autoloadRoute(array_merge([$file], $params));
    }
}

if (!function_exists('InitFolder')) {
    function InitFolder($file, $folder, ...$params) {
        autoloadRoute(array_merge([$folder, $file], $params));
    }
}

// Custom Routes
Route::add('/', function () {
    View('welcome', ['title' => 'Selamat Datang di nuPHP Framework v3.0']);
});

Route::add('/welcome', function () {
    View('welcome', ['title' => 'Selamat Datang di nuPHP Framework v3.0']);
});

// Auto-load Modular Sub-Router Files (app/router/*.php or router/*.php or app/routes/*.php)
$routerDirs = [__DIR__ . '/router', __DIR__ . '/routes', dirname(__DIR__) . '/router'];
foreach ($routerDirs as $routerDir) {
    if (is_dir($routerDir)) {
        foreach (glob($routerDir . '/*.php') as $routerFile) {
            require_once $routerFile;
        }
    }
}

// Auto Router
Route::add('/(.*)', function ($fullPath) {
    $pathParts = explode('/', trim($fullPath, '/'));
    autoloadRoute($pathParts);
}, ['get', 'post', 'put', 'delete']);

// 404 Router 
Route::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    View('404');
});

Route::run(BASEPATH);
