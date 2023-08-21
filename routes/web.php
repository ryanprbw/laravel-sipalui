<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

include_once('admin_web.php');
Route::middleware('guest')->group(function () {
    include_once('landing_web.php');
    Route::prefix('login')->controller(AuthController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/', 'validation');
    });
});

Route::middleware('auth')->controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('logout');
});

