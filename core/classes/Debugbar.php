<?php

namespace App\Core;

class Debugbar
{
    protected static float $startTime = 0.0;

    public static function start(): void
    {
        self::$startTime = microtime(true);
        if (class_exists('\Illuminate\Database\Capsule\Manager')) {
            try {
                \Illuminate\Database\Capsule\Manager::enableQueryLog();
            } catch (\Throwable $e) {}
        }

        ob_start(function ($buffer) {
            if (!defined('APP_DEBUG') || !APP_DEBUG || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
                return $buffer;
            }

            if (!str_contains($buffer, '</body>')) {
                return $buffer;
            }

            $execTime = round((microtime(true) - self::$startTime) * 1000, 2);
            $memoryPeak = round(memory_get_peak_usage() / 1024 / 1024, 2);
            $queries = [];
            if (class_exists('\Illuminate\Database\Capsule\Manager')) {
                try {
                    $queries = \Illuminate\Database\Capsule\Manager::getQueryLog();
                } catch (\Throwable $e) {}
            }
            $queryCount = count($queries);

            $version = defined('NUPHP') ? NUPHP : '3.0.5';

            $debugHtml = <<<HTML
<div id="nuphp-debugbar" style="position:fixed;bottom:12px;right:12px;z-index:999999;font-family:system-ui,-apple-system,sans-serif;font-size:12px;background:rgba(15,23,42,0.9);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.15);color:#f8fafc;padding:6px 14px;border-radius:30px;box-shadow:0 8px 24px rgba(0,0,0,0.4);display:flex;align-items:center;gap:12px;">
    <span style="font-weight:700;color:#38bdf8;">🚀 nuPHP v{$version}</span>
    <span style="border-left:1px solid rgba(255,255,255,0.2);height:12px;"></span>
    <span>⏱️ <b>{$execTime} ms</b></span>
    <span>💾 <b>{$memoryPeak} MB</b></span>
    <span>🗄️ <b>{$queryCount} Queries</b></span>
</div>
HTML;

            return str_replace('</body>', $debugHtml . '</body>', $buffer);
        });
    }
}
