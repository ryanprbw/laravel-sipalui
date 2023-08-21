<?php

use App\Http\Controllers\Admin\Receiver\ReceiverPriorityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['agency'])->group(function () {
    Route::prefix('receiver')->group(function () {
        Route::prefix('priority')->controller(ReceiverPriorityController::class)->group(function () {
            Route::get('/', 'index')->name('receive-priority');
            Route::post('/', 'store');
            Route::delete('/{receiverPriority}', 'delete');
            Route::get('datatable', 'dataTable')->name('receive-priority-datatable');
        });
    });
});
