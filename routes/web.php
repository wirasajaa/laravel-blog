<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->prefix('/accounts')->middleware('guest')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/register', 'storeUser')->name('store.user');
});
Route::prefix('/admins')->middleware('auth')->group(function () {
    Route::post('accounts/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(BlogController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard')->name('dashboard');
        Route::get('/articles', 'index')->name('articles');
        Route::get('/articles/new', 'create')->name('articles.create');
        Route::post('/articles/save', 'store')->name('articles.store');
        Route::delete('/articles/{blog:slug}/delete', 'destroy')->name('articles.delete');
        Route::get('/articles/{blog:slug}/show', 'show')->name('articles.show');
        Route::get('/articles/{blog:slug}/edit', 'edit')->name('articles.edit');
    });
});

Route::get('/', [UserController::class, 'index'])->name('home');
