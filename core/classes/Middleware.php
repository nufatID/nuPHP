<?php

namespace App\Core;

class Middleware
{
    protected static array $registry = [];

    public static function register(string $name, callable|string $handler): void
    {
        self::$registry[$name] = $handler;
    }

    public static function run(string|array $names): bool
    {
        $names = (array)$names;
        foreach ($names as $name) {
            if (isset(self::$registry[$name])) {
                $handler = self::$registry[$name];
                if (is_callable($handler)) {
                    $result = call_user_func($handler);
                    if ($result === false) return false;
                } elseif (class_exists($handler) && method_exists($handler, 'handle')) {
                    $instance = new $handler();
                    $result = $instance->handle();
                    if ($result === false) return false;
                }
            } elseif (class_exists($name) && method_exists($name, 'handle')) {
                $instance = new $name();
                $result = $instance->handle();
                if ($result === false) return false;
            }
        }
        return true;
    }
}
