<?php
declare(strict_types=1);

// Simple autoload (no composer) — keep it tiny.
spl_autoload_register(function (string $class): void {
    $paths = [
        __DIR__ . '/../app/core/' . $class . '.php',
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];
    foreach ($paths as $p) {
        if (file_exists($p)) { require $p; return; }
    }
});
