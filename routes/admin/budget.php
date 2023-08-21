<?php

use App\Http\Controllers\Admin\Budget\BudgetGovernmentController;
use Illuminate\Support\Facades\Route;


Route::prefix('budget')->group(function () {
    Route::middleware(['government'])->group(function () {
        Route::prefix('government')->controller(BudgetGovernmentController::class)->group(function () {
            Route::get('/', 'index')->name('budget-government');
            Route::get('load-budget/{governmentID}', 'loadBudgetGovID')->name('load-budget-government');
            Route::post('/', 'store');
            Route::delete('/{budget}', 'delete');
        });
    });
});
