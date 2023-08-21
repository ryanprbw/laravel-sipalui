<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;

Route::controller(AssistanceController::class)->group(function () {
    Route::get('/assistance', 'index')->name('assistance');
    Route::get('/assistance/load-assistance-family', 'loadAssistanceFamily')->name('assistance.load-data-family');
    Route::get('/assistance/load-city-assistance-desil', 'loadCityAssistanceDesil')->name('assistance.load-city-assistance-desil');
    Route::get('/assistance/export-city-assistance-desil', 'exportCityAssistanceDesil')->name('assistance.export-city-assistance-desil');
});
