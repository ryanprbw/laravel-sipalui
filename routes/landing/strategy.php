<?php

use App\Http\Controllers\StrategyController;
use Illuminate\Support\Facades\Route;

Route::controller(StrategyController::class)->group(function () {
    Route::get('/strategy', 'index')->name('strategy');
    Route::get('/strategy/load-strategy-city', 'loadStrategyCity')->name('strategy.load-strategy-city');
});
