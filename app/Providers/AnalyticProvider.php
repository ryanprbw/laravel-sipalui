<?php

namespace App\Providers;

use App\Services\AnalyticService;
use App\Services\Implements\AnalyticServiceImplement;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AnalyticProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        AnalyticService::class => AnalyticServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            AnalyticService::class
        ];
    }

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
