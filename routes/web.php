<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search', [SearchController::class, 'search']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/u/{id}', [UserController::class, 'view'])->name('user-view');

Route::group(['prefix' => 'f', 'middleware' => 'auth'], function() {
    Route::get('/create', [ForumController::class, 'create'])->name('forum-thread-create');
    Route::post('/create', [ForumController::class, 'store']);
});

Route::group(['prefix' => 'f'], function() {
    Route::get('/{id}', [ForumController::class, 'view'])->name('forum-thread-view');
});