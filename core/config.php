<?php

if (!function_exists('env')) {
    function env($key, $default = null) {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }
        return $value;
    }
}

if (!defined('BASE_DIR')) define('BASE_DIR', env('BASE_DIR', '/'));
if (!defined('APP_ENV')) define('APP_ENV', env('APP_ENV', 'development'));
if (!defined('APP_DEBUG')) define('APP_DEBUG', filter_var(env('APP_DEBUG', true), FILTER_VALIDATE_BOOLEAN));
if (!defined('APP_KEY')) define('APP_KEY', env('APP_KEY', 'base64:nuPHPSecretKey12345678901234567890'));

// Database connection constants
if (!defined('DB_DRIVER')) define('DB_DRIVER', env('DB_DRIVER', 'mysql'));
if (!defined('DB_HOST')) define('DB_HOST', env('DB_HOST', '127.0.0.1'));
if (!defined('DB_PORT')) define('DB_PORT', env('DB_PORT', '3306'));
if (!defined('DB_USER')) define('DB_USER', env('DB_USER', 'root'));
if (!defined('DB_PASS')) define('DB_PASS', env('DB_PASS', ''));
if (!defined('DB_NAME')) define('DB_NAME', env('DB_NAME', 'nuphp'));

// Auth System
if (!defined('AUTH')) define('AUTH', filter_var(env('AUTH', false), FILTER_VALIDATE_BOOLEAN));

// Email System SMTP
if (!defined('SMTP_HOST')) define('SMTP_HOST', env('SMTP_HOST', ''));
if (!defined('EMAIL_NAMA')) define('EMAIL_NAMA', env('EMAIL_NAMA', 'nuPHP Admin'));
if (!defined('EMAIL_ADR')) define('EMAIL_ADR', env('EMAIL_ADR', 'admin@nuphp.local'));
if (!defined('EMAIL_PASS')) define('EMAIL_PASS', env('EMAIL_PASS', ''));

// Version
if (!defined('APP_VERSION')) define('APP_VERSION', env('APP_VERSION', '3.0.4'));
if (!defined('NUPHP')) define('NUPHP', env('NUPHP', '3.0.4'));

