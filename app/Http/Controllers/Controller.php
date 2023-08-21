<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public final function setFlash(string $message, bool $status = false): void
    {
        session()->flash('message', $message);
        session()->flash('status', $status);
    }


    public final function yearDefault(): int
    {
        return date('Y');
    }

    public final function governmentID(Request $request): string
    {
        return $request->get('government') ? decrypt($request->get('government')) : '';
    }

    public final function agencyID(Request $request): string
    {
        return $request->get('agency') ? decrypt($request->get('agency')) : '';
    }
}
