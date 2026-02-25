<?php
// DEPLOY_ID: KING_EMYU_ULTIMATE_V4_HTTPS
// Last Deployment Force Fix: 2026-02-26 01:15:00 WIB
// Fixing: "Information you're about to submit is not secure" & Write Access

use Illuminate\Http\Request;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Filesystem\Filesystem;

define('LARAVEL_START', microtime(true));

// 1. FORCE HTTPS (SATISFY BROWSER SECURITY)
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

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

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Force storage path
    $app->useStoragePath($storagePath);

    // CRITICAL: Re-register PackageManifest with writable path
    $app->instance(PackageManifest::class, new PackageManifest(
        new Filesystem,
        $app->basePath(),
        $cachePath . '/packages.php'
    ));

    // 2. FORCE URL SCHEME TO HTTPS
    $app->booted(function ($app) {
        \Illuminate\Support\Facades\URL::forceScheme('https');

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
        }
    });

    // Handle Request
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Request::capture()
    )->send();
    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error (Ultimate Fix)</h1>";
    echo "<h3>Message: " . $e->getMessage() . "</h3>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<b>Stack Trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
}
