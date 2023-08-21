<?php

namespace App\Providers;

use App\Services\Implements\StrategyServiceImplement;
use App\Services\StrategyService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class StrategyProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        StrategyService::class => StrategyServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            StrategyService::class
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
