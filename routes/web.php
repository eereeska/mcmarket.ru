<?php

use App\Http\Controllers\Articles\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Balance\DepositController;
use App\Http\Controllers\Conversations\ConversationController;
use App\Http\Controllers\Files\FileController;
use App\Http\Controllers\Files\FileMediaController;
use App\Http\Controllers\Files\FilePurchaseController;
use App\Http\Controllers\Files\FileUpdateController;
use App\Http\Controllers\Files\UserFileController;
use App\Http\Controllers\Groups\GroupController;
use App\Http\Controllers\Groups\GroupFollowController;
use App\Http\Controllers\Search\UserSearchController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', [FileController::class, 'index'])->name('home');
Route::get('/test', function() {
    return view('test');
});

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


Route::group(['prefix' => 'search', 'middleware' => 'auth'], function() {
    Route::post('/users', [UserSearchController::class, 'search'])->name('search.users');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware(['guest', 'captcha']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware(['guest', 'captcha']);

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserController::class, 'updateSettings']);
    Route::get('/balance/deposit', [DepositController::class, 'deposit'])->name('deposit');
});

Route::group(['prefix' => 'upload', 'middleware' => 'auth'], function() {
    Route::post('/avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
});

Route::group(['prefix' => 'u/{name}'], function() {
    Route::get('/', [UserController::class, 'show'])->name('user.show');

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/follow', [UserController::class, 'follow'])->name('user.follow');
    });
});

Route::group(['prefix' => 'groups'], function() {
    Route::get('/', [GroupController::class, 'index'])->name('groups.index');
});

Route::group(['prefix' => 'group'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/create', [GroupController::class, 'create'])->name('group.create');
        Route::post('/create', [GroupController::class, 'store']);

        Route::group(['prefix' => '/{slug}'], function() {
            Route::post('/follow', [GroupFollowController::class, 'follow'])->name('group.follow');
            Route::post('/unfollow', [GroupFollowController::class, 'unfollow'])->name('group.unfollow');
        });
    });

    Route::get('/{slug}', [GroupController::class, 'show'])->name('group.show');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

Route::group(['prefix' => 'files'], function() {
    Route::get('/my', [UserFileController::class, 'index'])->middleware('auth')->name('files.my');
});

Route::group(['prefix' => 'file'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/submit', [FileController::class, 'submit'])->middleware('role:admin')->name('file.submit');
        Route::post('/submit', [FileController::class, 'store'])->middleware('role:admin');

        Route::group(['prefix' => '/{id}'], function() {
            Route::get('/purchase', [FilePurchaseController::class, 'create'])->name('file.purchase');
            Route::post('/purchase', [FilePurchaseController::class, 'store']);
            Route::get('/edit', [FileController::class, 'edit'])->name('file.edit');
            Route::post('/edit', [FileController::class, 'update']);
            Route::delete('/delete', [FileController::class, 'destroy'])->middleware('ajax')->name('file.delete');
            Route::post('/media', [FileMediaController::class, 'store'])->middleware('ajax')->name('file.media');
            Route::post('/media/{media}/delete', [FileMediaController::class, 'destroy'])->middleware('ajax')->name('file.media.delete');

            Route::group(['prefix' => '/update'], function() {
                Route::get('/submit', [FileUpdateController::class, 'submit'])->name('file.update.submit');
                Route::post('/submit', [FileUpdateController::class, 'store'])->name('file.update.store');
            });
        });
    });

    Route::group(['prefix' => '/{id}'], function() {
        Route::get('/', [FileController::class, 'show'])->name('file.show');
        Route::get('/download', [FileController::class, 'download'])->name('file.download');
    });
});

Route::get('/conversations', [ConversationController::class, 'index'])->middleware('auth')->name('conversations.index');

Route::group(['prefix' => 'conversation', 'middleware' => 'auth'], function() {
    Route::get('/{id}', [ConversationController::class, 'show'])->name('conversation.show');
});