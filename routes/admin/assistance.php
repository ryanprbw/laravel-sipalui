<?php

use App\Http\Controllers\Admin\Assistance\InnovationController;
use App\Http\Controllers\Admin\Assistance\PriorityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::prefix('assistance')->group(function () {
        Route::prefix('priority')->controller(PriorityController::class)->group(function () {
            Route::get('/', 'index')->name('assistance-priority');
            Route::post('/', 'store');
            Route::post('/{priority}', 'delete');
        });
        Route::prefix('innovation')->controller(InnovationController::class)->group(function () {
            Route::get('/', 'index')->name('assistance-innovation');
            Route::post('/', 'store');
            Route::post('/{innovation}', 'delete');
        });
    });
});
