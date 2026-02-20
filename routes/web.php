<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

Route::get('/', [PageController::class , 'home'])->name('home');
Route::get('/about', [PageController::class , 'about'])->name('about');
Route::get('/services', [PageController::class , 'services'])->name('services');
Route::get('/projects', [PageController::class , 'projects'])->name('projects');
Route::get('/contact', [PageController::class , 'contact'])->name('contact');
Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', \App\Http\Controllers\Admin\AdminController::class)->name('dashboard');
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);
});
