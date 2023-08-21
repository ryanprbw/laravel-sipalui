<?php

use App\Http\Controllers\AnalyticController;
use Illuminate\Support\Facades\Route;

Route::controller(AnalyticController::class)->prefix('analytic')->group(function () {
    Route::get('/', 'index')->name('analytic');

    Route::get('/load-data-assistance', 'loadDataAnalyticAssistance')->name('analytic.load-data-assistance');
    Route::get('/load-data-assistance-desil', 'loadAnalyticAssistanceDesil')->name('analytic.load-data-assistance-desil');
    Route::get('/export-assistance-desil', 'exportAnalyticAssistanceDesil')->name('analytic.export-assistance-desil');

    Route::get('/load-data-facility', 'loadDataAnalyticFacility')->name('analytic.load-data-facility');
    Route::get('/load-data-population', 'loadDataAnalyticFacilityPopulation')->name('analytic.load-data-facility-population');
    Route::get('/export-facility-population', 'exportAnalyticFacilityPopulation')->name('analytic.export-facility-population');

    Route::get('/load-data-strategy', 'loadDataAnalyticStrategy')->name('analytic.load-data-strategy');
    Route::get('/load-data-strategy-population', 'loadDataAnalyticStrategyPopulation')->name('analytic.load-data-strategy-population');
});
