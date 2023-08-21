<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public final function __invoke()
    {
        $users = auth()->user();
        return view('admin.pages.home-page', compact('users'));
    }
}
