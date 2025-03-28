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
use App\Core\Csrf;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
function views($viewName, $templateData)
{
    // Note that you can set several directories where your templates are located
    $pathsToTemplates = [__DIR__ . '/templates'];
    $pathToCompiledTemplates = __DIR__ . '/cache';

    // Dependencies
    $filesystem = new Filesystem;
    $eventDispatcher = new Dispatcher(new Container);

    // Create View Factory capable of rendering PHP and Blade templates
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

    // Render template
    echo $viewFactory->make($viewName, $templateData)->render();
}

require_once('core/functional.php');
require_once('core/Connection.php');
require_once('app/index.php');

Csrf::start();

