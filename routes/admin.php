<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\Users\BanController;
use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::match(['get', 'post'], '/files', [FileController::class, 'index'])->name('admin.files.index');
Route::match(['get', 'post'], '/users', [UserController::class, 'index'])->name('admin.users.index');

Route::group(['prefix' => 'file/{id}'], function() {
    Route::get('/edit', [FileController::class, 'edit'])->name('admin.file.edit');
    Route::post('/edit', [FileController::class, 'update']);
    Route::post('/approve', [FileController::class, 'approve'])->name('admin.file.approve');
});

Route::group(['prefix' => 'user/{id}'], function() {
    Route::group(['middleware' => 'permission:can_edit_users'], function() {
        Route::get('/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/edit', [UserController::class, 'update']);
    });

    Route::group(['middleware' => 'permission:can_ban'], function() {
        Route::get('/ban', [BanController::class, 'index'])->name('admin.user.ban');
        Route::post('/ban', [BanController::class, 'store']);
    });
});