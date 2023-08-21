<?php

use App\Http\Controllers\Admin\Government\GovernmentAgencyController;
use App\Http\Controllers\Admin\Government\GovernmentLocalController;
use Illuminate\Support\Facades\Route;


Route::prefix('government')->group(function () {
    Route::middleware(['administrator'])->group(function () {
        Route::prefix('local')->controller(GovernmentLocalController::class)->group(function () {
            Route::get('/', 'index')->name('government-local');
            Route::post('/', 'store');
            Route::delete('/{local}', 'delete');
        });
    });
    Route::middleware(['government'])->group(function () {
        Route::prefix('agency')->controller(GovernmentAgencyController::class)->group(function () {
            Route::get('/', 'index')->name('government-agency');
            Route::post('/', 'store');
            Route::delete('/{agency}', 'delete');
        });
    });

    Route::controller(GovernmentAgencyController::class)->group(function () {
        Route::get('load-agency-government', 'loadAgencyGovernment')->name('load-agency-government');
    });

});
