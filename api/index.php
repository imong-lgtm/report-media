<?php

// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(0);

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

// Create empty SQLite database if it doesn't exist
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Force HTTPS on Vercel
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Force Laravel to use /tmp for all cache files (Satisfy ProviderRepository and PackageManifest)
$cachePath = '/tmp/storage/framework/cache';
$cacheFiles = [
    'APP_CONFIG_CACHE' => $cachePath . '/config.php',
    'APP_SERVICES_CACHE' => $cachePath . '/services.php',
    'APP_PACKAGES_CACHE' => $cachePath . '/packages.php',
    'APP_ROUTES_CACHE' => $cachePath . '/routes.php',
    'APP_EVENTS_CACHE' => $cachePath . '/events.php',
];

foreach ($cacheFiles as $key => $path) {
    $_ENV[$key] = $path;
    putenv("{$key}={$path}");
}

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    // AUTO-REPAIR: Ensure DB is ready BEFORE handling the request
    if (!isset($_SERVER['ARTISAN_RUNNING'])) {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('users')) {
                \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);

                \App\Models\User::updateOrCreate(
                ['email' => 'admin@telecom.test'],
                [
                    'name' => 'Admin Redaksi',
                    'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                    'role' => 'superadmin',
                ]
                );
            }
        }
        catch (\Throwable $e) {
        }
    }

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    )->send();

    $kernel->terminate($request, $response);
}
catch (\Throwable $e) {
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<p><b>Message:</b> " . $e->getMessage() . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<b>Stack Trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
}
