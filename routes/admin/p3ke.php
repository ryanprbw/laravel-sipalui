<?php

use App\Http\Controllers\Admin\P3ke\FamilyController;
use App\Http\Controllers\Admin\P3ke\KeluargaController;
use App\Http\Controllers\Admin\P3ke\PopulationController;
use Illuminate\Support\Facades\Route;

Route::prefix('p3ke')->group(function () {
    Route::middleware(['administrator'])->group(function () {
        Route::prefix('population')->controller(PopulationController::class)->group(function () {
            Route::get('/', 'index')->name('population');
            Route::get('datatable', 'dataTable')->name('population-datatable');
        });
        Route::prefix('family')->controller(FamilyController::class)->group(function () {
            Route::get('/', 'index')->name('family');
            Route::post('/', 'store');
            Route::get('datatable', 'dataTable')->name('family-datatable');
        });

        Route::prefix('import-keluarga')->controller(KeluargaController::class)->group(function () {
            Route::get('/', 'index')->name('import-keluarga');
            Route::get('/load-all-city', 'loadDataAllCity')->name('import-keluarga-load-city');
            Route::post('/', 'store');
        });
    });

    Route::controller(FamilyController::class)->group(function () {
        Route::get('load-family-region', 'loadFamilyRegion');
        Route::post('select-family', 'selectFamily')->name('select-family');
    });
});
