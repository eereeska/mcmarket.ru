<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Conversations\ConversationController;
use App\Http\Controllers\Files\FileController;
use App\Http\Controllers\Files\FilePurchaseController;
use App\Http\Controllers\FileVersionController;
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
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserController::class, 'updateSettings']);
});

Route::group(['prefix' => 'upload', 'middleware' => 'auth'], function() {
    Route::post('/avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
});

Route::group(['prefix' => 'u/{user:name}'], function() {
    Route::get('/', [UserController::class, 'show'])->name('user.show');

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/follow', [UserController::class, 'follow'])->name('user.follow');
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

Route::group(['prefix' => 'file'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/submit', [FileController::class, 'submit'])->name('file.submit');
        Route::post('/submit', [FileController::class, 'store'])->name('file.store');

        Route::group(['prefix' => '/{file}'], function() {
            Route::get('/download', [FileController::class, 'download'])->name('file.download');
            Route::get('/purchase', [FilePurchaseController::class, 'create'])->name('file.purchase');
            Route::post('/purchase', [FilePurchaseController::class, 'store']);
            Route::get('/edit', [FileController::class, 'edit'])->name('file.edit');
            Route::post('/edit', [FileController::class, 'update'])->name('file.update');
            Route::post('/delete', [FileController::class, 'destroy'])->middleware('ajax')->name('file.delete');
            Route::post('/media', [FileController::class, 'addMedia'])->middleware('ajax')->name('file.media');
            Route::post('/media/{media}/delete', [FileController::class, 'deleteMedia'])->middleware('ajax')->name('file.media.delete');

            Route::group(['prefix' => '/version'], function() {
                Route::get('/submit', [FileVersionController::class, 'submit'])->name('file.version.submit');
                Route::post('/submit', [FileVersionController::class, 'store']);
            });
        });
    });

    Route::get('/{file}', [FileController::class, 'show'])->name('file.show');
});

Route::get('/conversations', [ConversationController::class, 'index'])->middleware('auth')->name('conversations.index');

Route::group(['prefix' => 'conversation', 'middleware' => 'auth'], function() {
    Route::get('/{id}', [ConversationController::class, 'show'])->name('conversation.show');
});