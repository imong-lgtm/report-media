<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure temporary storage directories exist for Vercel
$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
}
catch (\Throwable $e) {
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<p><b>Message:</b> " . $e->getMessage() . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<b>Stack Trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
}
