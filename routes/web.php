<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index'])->name('home');

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
    Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/mark-read', [UserController::class, 'notificationsMarkRead'])->name('notifications-mark-read');
    Route::get('/notifications/delete', [UserController::class, 'notificationsDelete'])->name('notifications-delete');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserController::class, 'updateSettings']);
});

Route::group(['prefix' => 'upload', 'middleware' => 'auth'], function() {
    Route::post('/avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
});

Route::group(['prefix' => 'u/{name}'], function() {
    Route::get('/', [UserController::class, 'show'])->name('user-show');

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/follow', [UserController::class, 'follow'])->name('user-follow');
    });
});

Route::group(['prefix' => 'groups'], function() {
    Route::get('/', [GroupController::class, 'index'])->name('groups-index');
});

Route::group(['prefix' => 'group'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/create', [GroupController::class, 'create'])->name('group-create');
        Route::post('/create', [GroupController::class, 'store']);
    });

    Route::get('/{slug}', [GroupController::class, 'show'])->name('group-show');
});

Route::group(['prefix' => 't'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/create', [ForumController::class, 'create'])->name('forum-thread-create');
        Route::post('/create', [ForumController::class, 'store']);

        Route::post('/{id}/reply', [ForumController::class, 'reply'])->name('forum-thread-reply');
    });

    Route::get('/{id}', [ForumController::class, 'show'])->name('forum-thread-show');
});

Route::group(['prefix' => 'files'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/submit', [FileController::class, 'submit'])->name('files-submit');
        Route::post('/submit', [FileController::class, 'store']);
    });

    Route::get('/{id}', [FileController::class, 'show'])->name('file-show');
});

Route::get('/file/{id}/download', [FileController::class, 'download'])->middleware('auth')->name('file-download');