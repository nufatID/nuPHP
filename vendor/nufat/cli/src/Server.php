<?php

namespace Nufat\Cli;

class Server
{
    public function start($port = 8009, $directory = 'public_html')
    {
        $command = sprintf('php -S localhost:%d -t %s', $port, $directory);
        return shell_exec($command);
    }
}
