<?php

use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;

Route::controller(DistributionController::class)->group(function () {
    Route::get('/distribution', 'index')->name('distribution');
    Route::get('/distribution/load-data', 'loadDistribution')->name('distribution.load-data');
    Route::get('/distribution/export-distinct', 'exportDistributionDistrict')->name('distribution.export-distinct');
    Route::get('/distribution/export-village', 'exportDistributionVillage')->name('distribution.export-village');
});
