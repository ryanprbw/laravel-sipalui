<?php

use App\Http\Controllers\NominationController;
use Illuminate\Support\Facades\Route;

Route::controller(NominationController::class)->prefix('nomination')->group(function () {
    Route::get('/', 'index')->name('nomination');
    Route::get('/load-facility', 'loadFacility')->name('nomination.load-facility');
    Route::get('/load-receiver', 'loadReceiver')->name('nomination.load-receiver');
    Route::post('/', 'store');
});
