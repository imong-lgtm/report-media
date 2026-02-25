<?php
// Last Deployment Force Fix: 2026-02-26 00:52:00 WIB
// Compatible with Laravel 8/9/10/11 - Bypassing Facade root errors.

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Setup temporary storage directories for Vercel
if (!is_dir('/tmp/storage')) {
    mkdir('/tmp/storage', 0777, true);
    mkdir('/tmp/storage/framework/views', 0777, true);
    mkdir('/tmp/storage/framework/cache', 0777, true);
    mkdir('/tmp/storage/framework/sessions', 0777, true);
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Force storage and database paths for Vercel
    $app->useStoragePath('/tmp/storage');

    // Auto-setup database at runtime
    $app->booted(function ($app) {
        $tempDb = '/tmp/database.sqlite';
        if (!file_exists($tempDb)) {
            touch($tempDb);
            chmod($tempDb, 0666);
        }

        // Use direct $app instance access to avoid "Facade root not set"
        $app['config']->set('database.connections.sqlite.database', $tempDb);

        try {
            $db = $app->make('db');
            $schema = $db->connection('sqlite')->getSchemaBuilder();

            if (!$schema->hasTable('users')) {
                $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
                $kernel->call('migrate', ['--force' => true]);

                // Seed for Newspaper Project
                if (file_exists(__DIR__ . '/../database/seeders/CategorySeeder.php')) {
                    $kernel->call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
                }
                if (file_exists(__DIR__ . '/../database/seeders/ArticleSeeder.php')) {
                    $kernel->call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);
                }

                // Create Default Fallback Admin
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

    // Handle Request (Compatible with Laravel 8/9/10)
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
