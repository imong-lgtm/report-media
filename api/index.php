<?php
// DEPLOY_ID: KING_EMYU_GOAL_2026_V2_CACHE_FIX
// Last Deployment Force Fix: 2026-02-26 01:00:00 WIB
// Fixing: "bootstrap/cache directory must be present and writable"

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Setup temporary storage and cache directories for Vercel
$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    $cachePath,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// CRITICAL: Overwrite environment variables BEFORE booting the app
// This forces Laravel to use /tmp for its discovery files (packages.php, services.php)
$_ENV['APP_CONFIG_CACHE'] = $cachePath . '/config.php';
$_ENV['APP_SERVICES_CACHE'] = $cachePath . '/services.php';
$_ENV['APP_PACKAGES_CACHE'] = $cachePath . '/packages.php';
$_ENV['APP_ROUTES_CACHE'] = $cachePath . '/routes.php';
$_ENV['APP_EVENTS_CACHE'] = $cachePath . '/events.php';

foreach ($_ENV as $key => $value) {
    if (strpos($key, 'APP_') === 0 && strpos($key, '_CACHE') !== false) {
        putenv("{$key}={$value}");
    }
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Force storage and database paths for Vercel
    $app->useStoragePath($storagePath);

    // Auto-setup database at runtime
    $app->booted(function ($app) {
        $tempDb = '/tmp/database.sqlite';
        if (!file_exists($tempDb)) {
            touch($tempDb);
            chmod($tempDb, 0666);
        }

        $app['config']->set('database.connections.sqlite.database', $tempDb);

        try {
            $db = $app->make('db');
            $schema = $db->connection('sqlite')->getSchemaBuilder();

            if (!$schema->hasTable('users')) {
                $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
                $kernel->call('migrate', ['--force' => true]);

                if (file_exists(__DIR__ . '/../database/seeders/CategorySeeder.php')) {
                    $kernel->call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
                }
                if (file_exists(__DIR__ . '/../database/seeders/ArticleSeeder.php')) {
                    $kernel->call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);
                }

                \App\Models\User::updateOrCreate(
                    ['email' => 'admin@telco.id'],
                    [
                        'name' => 'Admin Redaksi',
                        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                        'role' => 'superadmin',
                    ]
                );
            }
        } catch (\Exception $e) {
            // App continues
        }
    });

    // Handle Request (Compatible with Laravel 8/9/10/11)
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Request::capture()
    )->send();
    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<h3>Message: " . $e->getMessage() . "</h3>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<b>Stack Trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
}
