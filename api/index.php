<?php
// DEPLOY_ID: KING_EMYU_ULTIMATE_V6_TOP_LEVEL_ENV
// Last Deployment Force Fix: 2026-02-26 01:25:00 WIB
// Fixing: "bootstrap/cache directory must be present and writable" (Top-Level Env Fix)

define('LARAVEL_START', microtime(true));

// 1. SETUP WRITABLE DIRECTORIES IN /TMP
$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    '/tmp/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// 2. CRITICAL: SET ENVIRONMENT VARIABLES AT THE VERY START
$overrides = [
    'APP_CONFIG_CACHE' => $cachePath . '/config.php',
    'APP_SERVICES_CACHE' => $cachePath . '/services.php',
    'APP_PACKAGES_CACHE' => $cachePath . '/packages.php',
    'APP_ROUTES_CACHE' => $cachePath . '/routes.php',
    'APP_EVENTS_CACHE' => $cachePath . '/events.php',
    'LARAVEL_STORAGE_PATH' => $storagePath,
];

foreach ($overrides as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// 3. FORCE HTTPS
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

use Illuminate\Http\Request;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Filesystem\Filesystem;

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // 4. BIND WRITABLE PATHS TO CONTAINER
    $app->useStoragePath($storagePath);

    // Attempt to override bootstrap path and package manifest
    $app->instance(PackageManifest::class, new PackageManifest(
        new Filesystem,
        $app->basePath(),
        $cachePath . '/packages.php'
    ));

    // Handle Request logic
    $app->booted(function ($app) {
        \Illuminate\Support\Facades\URL::forceScheme('https');

        // SQLite fallback for Vercel
        if (env('DB_CONNECTION') === 'sqlite' || !env('DB_CONNECTION')) {
            $tempDb = '/tmp/database.sqlite';
            if (!file_exists($tempDb)) {
                @touch($tempDb);
                @chmod($tempDb, 0666);
            }
            $app['config']->set('database.connections.sqlite.database', $tempDb);
        }

        // Auto-migrate if needed (Skip if already migrated)
        try {
            $db = $app->make('db');
            $schema = $db->connection()->getSchemaBuilder();

            if (!$schema->hasTable('users')) {
                $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
                $kernel->call('migrate', ['--force' => true]);

                // Seed logic
                $kernel->call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
                $kernel->call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);

                \App\Models\User::updateOrCreate(
                    ['email' => 'admin@telco.id'],
                    ['name' => 'Admin Redaksi', 'password' => \Illuminate\Support\Facades\Hash::make('password123'), 'role' => 'superadmin']
                );
            }
        } catch (\Exception $e) {
            // Silently fail or log in bootstrap
        }
    });

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Request::capture()
    )->send();
    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error (Top-Level Env Fix)</h1>";
    echo "<h3>Message: " . $e->getMessage() . "</h3>";
    echo "<p><b>Location:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<b>Diagnostic Trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
}
