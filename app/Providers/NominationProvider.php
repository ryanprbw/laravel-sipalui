<?php

namespace App\Providers;

use App\Services\Implements\NominationServiceImplement;
use App\Services\NominationService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NominationProvider extends ServiceProvider implements DeferrableProvider
{


    public array $singletons = [
        NominationService::class => NominationServiceImplement::class,
    ];


    public final function provides(): array
    {
        return [
            NominationService::class
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }
}
