<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// SECURITY WARNING: Run this ONCE then restrict access.
if (true) { // Temporarily allow for initial cloud setup
    Route::get('/setup-admin', function () {
        return view('setup');
    });

    Route::post('/setup-admin', function (\Illuminate\Http\Request $request) {
        try {
            $data = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            $output = "";

            // 1. Run Migrations (Fresh to ensure schema is correct on Vercel)
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
            $output .= "<b>Migration Output:</b><br>" . nl2br(\Illuminate\Support\Facades\Artisan::output()) . "<br>";

            // 1.5 Run Seeders
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);
            $output .= "<b>Seeding Output:</b><br>Berita & Kategori berhasil dimuat!<br>";

            // 1.6 Directory Fix (Only if not on Vercel or using /tmp)
            $storagePath = storage_path('app/public/articles');
            if (!file_exists($storagePath)) {
                @mkdir($storagePath, 0777, true);
            }
            $output .= "<b>Storage Fix:</b><br>Articles directory ready!<br>";

            // 2. Force Add Column if missing (SQLite Manual Fix)
            if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'role')) {
                $output .= "Column 'role' not found after migration. Attempting manual fix...<br>";
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE users ADD COLUMN role TEXT DEFAULT "admin"');
                $output .= "Manual fix applied!<br>";
            }

            // 3. Create/Update User
            $user = User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => 'Superadmin',
                'password' => Hash::make($data['password']),
                'role' => 'superadmin',
            ]
            );

            $output .= "<br><div style='color:green; font-weight:bold; font-size:1.2rem;'>SUCCESS! Superadmin account created & Database Fixed!</div><br>Email: " . $data['email'] . "<br><br><a href='/login' style='padding:10px 20px; background:blue; color:white; border-radius:8px; text-decoration:none;'>Go to Login Page</a><br><br><b>Technical Details:</b><br>" . $output;

            return response($output);
        }
        catch (\Exception $e) {
            return back()->with('error', "Error during setup: " . $e->getMessage());
        }
    });
}

Route::get('/', [PageController::class , 'home'])->name('home');
Route::get('/article/{slug}', [PageController::class , 'showArticle'])->name('articles.show');
Route::get('/about', [PageController::class , 'about'])->name('about');
Route::get('/services', [PageController::class , 'services'])->name('services');
Route::get('/projects', [PageController::class , 'projects'])->name('projects');
Route::get('/contact', [PageController::class , 'contact'])->name('contact');
Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');

// Auth Routes
Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
Route::post('/login', [AuthController::class , 'login'])->name('login.post');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', \App\Http\Controllers\Admin\AdminController::class)->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show', 'edit', 'update']);
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['edit', 'update', 'show'])->middleware('superadmin');
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);
});
