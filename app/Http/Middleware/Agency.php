<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Agency
{

    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->level_id === 3 || auth()->user()->level_id === 1) {
            return $next($request);
        }
        if (auth()->hasUser()) {
            return abort('404');
        } else {
            return view('errors.error-landing', ['message' => '']);
        }
    }
}
