<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct()
    {
    }

    public final function __invoke()
    {
        return view('landing.pages.evaluation-page');
    }
}
