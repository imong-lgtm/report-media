<?php
// Last Deployment Fix for Newspaper Site (Auto-Repair): 2026-02-26_v2

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

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<h3>Message: " . $e->getMessage() . "</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
