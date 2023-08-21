<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/load-distribution-city', 'loadDistributionCity')->name('home.load-distribution-city');
    Route::get('/load-distribution-persen-city', 'loadDistributionPersenCity')->name('home.load-distribution-persen-city');
});

