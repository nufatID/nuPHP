<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

// Load environment variables safely
if (class_exists('Dotenv\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
}

// Require config & core functions
require_once __DIR__ . '/core/config.php';

// Configure Error Display based on APP_DEBUG
if (defined('APP_DEBUG') && APP_DEBUG) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    if (class_exists('App\Core\Debugbar')) {
        App\Core\Debugbar::start();
    }
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

function views($viewName, $templateData = [])
{
    $pathsToTemplates = [__DIR__ . '/templates', __DIR__ . '/views'];
    $pathToCompiledTemplates = __DIR__ . '/cache';

    if (!is_dir($pathToCompiledTemplates)) {
        @mkdir($pathToCompiledTemplates, 0755, true);
    }

    $filesystem = new Filesystem;
    $eventDispatcher = new Dispatcher(new Container);

    $viewResolver = new EngineResolver;
    $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);
    $viewResolver->register('blade', function () use ($bladeCompiler) {
        return new CompilerEngine($bladeCompiler);
    });

    $viewResolver->register('php', function () {
        return new PhpEngine;
    });

    $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
    $viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);

    echo $viewFactory->make($viewName, $templateData)->render();
}

require_once __DIR__ . '/core/functional.php';
require_once __DIR__ . '/core/Connection.php';
require_once __DIR__ . '/app/index.php';

if (class_exists('App\Core\Csrf')) {
    App\Core\Csrf::start();
} elseif (class_exists('Csrf')) {
    Csrf::start();
}
