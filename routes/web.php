<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home');

Route::get('/contact', function() {
    return view('help.contact');
})->name('contact');

Route::get('/terms', function() {
    return view('help.terms');
})->name('terms');

Route::get('/privacy', function() {
    return view('help.privacy');
})->name('privacy');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search', [SearchController::class, 'search']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserController::class, 'updateSettings']);
});

Route::group(['prefix' => 'upload', 'middleware' => 'auth'], function() {
    Route::post('/avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
});

Route::get('/u/{name}', [UserController::class, 'show'])->name('user-show');

Route::group(['prefix' => 'd', 'middleware' => 'auth'], function() {
    Route::get('/create', [ForumController::class, 'create'])->name('forum-thread-create');
    Route::post('/create', [ForumController::class, 'store']);
});

Route::group(['prefix' => 't'], function() {
    Route::get('/{id}', [ForumController::class, 'show'])->name('forum-thread-show');
});