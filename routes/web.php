<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// SECURITY: Only enable on local or for restricted one-time setup
if (app()->environment('local')) {
    Route::get('/setup-admin', function () {
        return view('setup');
    });

    Route::post('/setup-admin', function (\Illuminate\Http\Request $request) {
        try {
            $data = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            // 1. Run Migrations
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);

            // 1.5 Run Seeders
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ArticleSeeder', '--force' => true]);

            // 1.6 Directory Fix
            $storagePath = storage_path('app/public/articles');
            if (!file_exists($storagePath)) {
                @mkdir($storagePath, 0777, true);
            }

            // 2. Create/Update User
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => 'Superadmin',
                    'password' => Hash::make($data['password']),
                    'role' => 'superadmin',
                ]
            );

            return response("<div style='color:green; font-weight:bold; font-size:1.2rem; text-align:center; padding-top:50px;'>SUCCESS! Superadmin account created.<br><br><a href='/login' style='padding:10px 20px; background:blue; color:white; border-radius:8px; text-decoration:none;'>Go to Login Page</a></div>");
        } catch (\Exception $e) {
            return back()->with('error', "Error during setup: " . $e->getMessage());
        }
    });
}

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/article/{slug}', [PageController::class, 'showArticle'])->name('articles.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/category/{slug}', [PageController::class, 'category'])->name('category.show');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::post('/newsletter', [ContactController::class, 'newsletter'])->name('newsletter.subscribe');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth Routes (Secret Path)
Route::get('/rahasia-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/rahasia-admin', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', \App\Http\Controllers\Admin\AdminController::class)->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show', 'edit', 'update']);
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show'])->middleware('superadmin');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [\App\Http\Controllers\Admin\CompanyProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\CompanyProfileController::class, 'update'])->name('update');
    });
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);
});
