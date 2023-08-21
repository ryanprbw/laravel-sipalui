<?php

use App\Http\Controllers\Api\ReceiverFamilyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::middleware('auth.session')->group(function () {
Route::prefix('receiver')->controller(ReceiverFamilyController::class)->group(function () {
    Route::get('/', 'index')->name('receiver');
});
//});
