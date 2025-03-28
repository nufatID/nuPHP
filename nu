#!/usr/bin/php
<?php

require 'vendor/autoload.php';

use Nufat\Cli\CliHandler;

$cliHandler = new CliHandler();
print_r($cliHandler->handle($argv));
