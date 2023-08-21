<?php

use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;


Route::get('/evaluation', EvaluationController::class)->name('evaluation');

