<?php

use App\Http\Controllers\Admin\Reference\NomenclatureController;
use App\Http\Controllers\Admin\Reference\RefCityController;
use App\Http\Controllers\Admin\Reference\RefDistrictController;
use App\Http\Controllers\Admin\Reference\RefVillageController;
use App\Http\Controllers\Admin\Reference\RegionController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::middleware(['administrator'])->group(function () {
            Route::get('administrator', 'administrator')->name('user-administrator');
            Route::get('government', 'government')->name('user-government');
        });

        Route::middleware(['government'])->group(function () {
            Route::get('agency', 'agency')->name('user-agency');
        });


        Route::post('/', 'store')->name('user-store');
        Route::put('/{user}', 'updateStatus');
        Route::delete('/{user}', 'delete');
    });


});
