<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/panel', [AuthController::class, 'panel'])->name('panel');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
