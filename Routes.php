<?php

use Steampixel\Route;

function newview($path, $params = [])
{
    extract($params);
    $viewFile = __DIR__ . '/views/' . $path . '.nu.php';

    if (file_exists($viewFile)) {
        View($path, $params);
    } else {
        header('HTTP/1.0 404 Not Found');
        View('404');
    }
}

function autoloadRoute($pathParts)
{
    $controllerBaseDir = 'app/controller';
    $routerBaseDir = '/router';
    $viewBaseDir = __DIR__ . '/views';
    $maxDepth = count($pathParts);

    for ($i = 0; $i < $maxDepth; $i++) {
        $currentPath = implode('/', array_slice($pathParts, 0, $i + 1));

        // Check if it's a PHP file in the controller directory
        $controllerFilePath = __DIR__ . '/' . $controllerBaseDir . '/' . $currentPath . '.php';
        if (file_exists($controllerFilePath)) {
            require_once $controllerFilePath;
            $className = ucfirst($pathParts[$i]);
            $methodName = $pathParts[$i + 1] ?? 'index';
            $controller = new $className();

            if (class_exists($className) && method_exists($controller, $methodName)) {
                $params = array_slice($pathParts, $i + 2);
                call_user_func_array([$controller, $methodName], $params);
            } else {
                $params = array_slice($pathParts, $i + 1);
                if (method_exists($controller, 'index')) {
                    call_user_func_array([$controller, 'index'], $params);
                } else {
                    header('HTTP/1.0 404 Not Found');
                    View('404');
                }
            }
            return;
        }

        // Check if it's a directory in the controller directory
        $controllerDirPath = __DIR__ . '/' . $controllerBaseDir . '/' . $currentPath;
        if (is_dir($controllerDirPath)) {
            if ($i + 1 < $maxDepth) {
                $phpFilePath = $controllerDirPath . '/' . $pathParts[$i + 1] . '.php';
                if (file_exists($phpFilePath)) {
                    require_once $phpFilePath;
                    $className = ucfirst($pathParts[$i + 1]);
                    $methodName = $pathParts[$i + 2] ?? 'index';
                    $controller = new $className();

                    if (class_exists($className) && method_exists($controller, $methodName)) {
                        $params = array_slice($pathParts, $i + 3);
                        call_user_func_array([$controller, $methodName], $params);
                    } else {
                        $params = array_slice($pathParts, $i + 2);
                        if (method_exists($controller, 'index')) {
                            call_user_func_array([$controller, 'index'], $params);
                        } else {
                            header('HTTP/1.0 404 Not Found');
                            View('404');
                        }
                    }
                    return;
                }
            }
        }



        // Check if the URL directly points to a file in the router directory
        $directFilePath = __DIR__ . '/' . $routerBaseDir . '/' . $pathParts[0] . '.php';
        if (file_exists($directFilePath)) {
            require_once $directFilePath;
            $className = ucfirst($pathParts[0]);
            $methodName = $pathParts[1] ?? 'index';
            $controller = new $className();

            if (class_exists($className) && method_exists($controller, $methodName)) {
                $params = array_slice($pathParts, 2);
                call_user_func_array([$controller, $methodName], $params);
            } else {
                $params = array_slice($pathParts, 1);
                if (method_exists($controller, 'index')) {
                    call_user_func_array([$controller, 'index'], $params);
                } else {
                    header('HTTP/1.0 404 Not Found');
                    View('404');
                }
            }
            return;
        }


        $routerDirPath = __DIR__ . '/' . $routerBaseDir . '/' . $currentPath;
        if (is_dir($routerDirPath)) {
            $phpFilePath = $routerDirPath . '/' . $pathParts[$i + 1] . '.php';
            if (file_exists($phpFilePath)) {
                require_once $phpFilePath;
                $className = ucfirst($pathParts[$i + 1]);
                $methodName = $pathParts[$i + 2] ?? 'index';
                $controller = new $className();

                if (class_exists($className) && method_exists($controller, $methodName)) {
                    $params = array_slice($pathParts, $i + 3);
                    call_user_func_array([$controller, $methodName], $params);
                } else {
                    $params = array_slice($pathParts, $i + 2);
                    if (method_exists($controller, 'index')) {
                        call_user_func_array([$controller, 'index'], $params);
                    } else {
                        header('HTTP/1.0 404 Not Found');
                        View('404');
                    }
                }
                return;
            }
        }
        // Check view directory
        $viewPath = $viewBaseDir . '/' . $currentPath . '.nu.php';

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

Route::add('/', function () {
    // Assuming you have a function `tolink` for redirection
    tolink('home');
});

// Define the route with a wildcard pattern
Route::add('/(.*)', function ($fullPath) {
    $pathParts = explode('/', trim($fullPath, '/'));
    autoloadRoute($pathParts);
}, ['get', 'post']);

// Run the router
Route::run('/');
