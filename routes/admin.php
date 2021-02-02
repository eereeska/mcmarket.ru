<?php

use App\Http\Controllers\Admin\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index']);