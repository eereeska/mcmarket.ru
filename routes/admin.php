<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::match(['get', 'post'], '/files', [FileController::class, 'index'])->name('admin.files.index');

// Route::group(['prefix' => 'files', 'namespace' => 'Files'], function() {
//     Route::post('')
// });

Route::group(['prefix' => 'file/{id}', 'namespace' => 'Files'], function() {
    Route::get('/edit', [FileController::class, 'edit'])->name('admin.file.edit');
    Route::post('/approve', [FileController::class, 'approve'])->name('admin.file.approve');
});