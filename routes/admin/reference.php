<?php

use App\Http\Controllers\Admin\Reference\NomenclatureController;
use App\Http\Controllers\Admin\Reference\RefCityController;
use App\Http\Controllers\Admin\Reference\RefDistrictController;
use App\Http\Controllers\Admin\Reference\RefVillageController;
use App\Http\Controllers\Admin\Reference\RegionController;
use Illuminate\Support\Facades\Route;


Route::prefix('reference')->group(function () {

    Route::prefix('region')->controller(RegionController::class)->group(function () {
        Route::get('/', 'index')->name('reference-region');
        Route::get('datatable', 'dataTable')->name('region-datatable');
    });

    Route::prefix('nomenclature')->controller(NomenclatureController::class)->group(function () {
        Route::get('/', 'index')->name('reference-nomenclature');
        Route::get('datatable', 'dataTable')->name('nomenclature-datatable');
        Route::post('select-subkegiatan', 'selectSubKegiatan')->name('select-subkegiatan');
        Route::get('load-subkegiatan-id/{subkegiatan}', 'loadSubKegiatanID')->name('load-subkegiatan');
    });

    Route::prefix('city')->controller(RefCityController::class)->group(function () {
        Route::get('load-city', 'loadCities');
    });

    Route::prefix('district')->controller(RefDistrictController::class)->group(function () {
        Route::get('load-district/{city_code}', 'loadDistricts');
    });

    Route::prefix('village')->controller(RefVillageController::class)->group(function () {
        Route::get('load-village/{city_code}/{district_code}', 'loadVillages');
    });
});
