<?php

namespace App\Providers;

use App\Services\Implements\P3keServiceImplement;
use App\Services\P3keService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class P3keProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        P3keService::class => P3keServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            P3keService::class
        ];
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
