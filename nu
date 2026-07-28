#!/usr/bin/env php
<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

if (class_exists('Nufat\Cli\CliHandler')) {
    $cliHandler = new Nufat\Cli\CliHandler();
    echo $cliHandler->handle($argv);
} else {
    $command = $argv[1] ?? 'help';
    $argument = $argv[2] ?? null;

    switch ($command) {
        case 'serve':
            $port = $argument ?? '8000';
            $host = '127.0.0.1';
            echo "\033[32mnuPHP Development Server started at http://{$host}:{$port}\033[0m\n";
            echo "Press Ctrl+C to stop.\n\n";
            passthru("php -S {$host}:{$port} -t " . escapeshellarg(__DIR__));
            break;

        case 'make:controller':
        case 'buat:controller':
            if (!$argument) {
                echo "\033[31mError: Controller name required! Usage: php nu make:controller <Name>\033[0m\n";
                exit(1);
            }
            $name = ucfirst($argument);
            $targetDir = __DIR__ . '/app/Controllers';
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $targetFile = $targetDir . '/' . $name . '.php';

            if (file_exists($targetFile)) {
                echo "\033[33mWarning: Controller {$name} already exists!\033[0m\n";
                exit(1);
            }

            $template = "<?php\n\nclass {$name}\n{\n    public function index()\n    {\n        View('home');\n    }\n}\n";
            file_put_contents($targetFile, $template);
            echo "\033[32mController {$name} created successfully in app/Controllers/{$name}.php\033[0m\n";
            break;

        case 'make:model':
        case 'buat:model':
            if (!$argument) {
                echo "\033[31mError: Model name required! Usage: php nu make:model <Name>\033[0m\n";
                exit(1);
            }
            $name = ucfirst($argument);
            $targetDir = __DIR__ . '/app/Models';
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $targetFile = $targetDir . '/' . $name . '.php';

            if (file_exists($targetFile)) {
                echo "\033[33mWarning: Model {$name} already exists!\033[0m\n";
                exit(1);
            }

            $tableName = strtolower($name) . 's';
            $template = "<?php\n\nnamespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$name} extends Model\n{\n    protected \$table = '{$tableName}';\n    protected \$guarded = [];\n}\n";
            file_put_contents($targetFile, $template);
            echo "\033[32mModel {$name} created successfully in app/Models/{$name}.php\033[0m\n";
            break;

        case 'version':
        case '-v':
            echo "nuPHP Framework Version 2.1.0 (PHP " . PHP_VERSION . ")\n";
            break;

        case 'help':
        default:
            echo "\033[34mnuPHP CLI Tool v2.1.0\033[0m\n\n";
            echo "Usage:\n";
            echo "  php nu serve [port]          Start local development server (default: 8000)\n";
            echo "  php nu buat c <Name>          Create Controller, Model & View\n";
            echo "  php nu buat api <Name>        Create REST API Controller\n";
            echo "  php nu buat m <Name>          Create Eloquent Model\n";
            echo "  php nu buat v <Name>          Create View\n";
            echo "  php nu buat migration <Name>  Create Migration file\n";
            echo "  php nu migrate               Run Database Migrations\n";
            echo "  php nu seed                  Run Database Seeders\n";
            echo "  php nu key:generate          Generate new APP_KEY in .env\n";
            echo "  php nu clear:cache           Clear compiled view cache\n";
            echo "  php nu version               Show nuPHP framework version\n";
            echo "  php nu help                  Show this help message\n";
            break;
    }
}

