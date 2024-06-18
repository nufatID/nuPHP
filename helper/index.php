<?php
// Automatically require all PHP files in the helper/functions directory
foreach (glob(__DIR__ . "/functions/*.php") as $filename) {
    require_once $filename;
}
