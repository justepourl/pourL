<?php
try {
    require __DIR__.'/../vendor/autoload.php';
    echo "autoload OK<br>";

    define('LARAVEL_START', microtime(true));

    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "app boot OK<br>";

    echo "Laravel " . $app::VERSION . " booted successfully<br>";
} catch (Throwable $e) {
    echo "<h1>Error:</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
