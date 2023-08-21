<?php

namespace App\Providers;

use App\Services\DistributionService;
use App\Services\Implements\DistributionServiceImplement;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DistributionProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        DistributionService::class => DistributionServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            DistributionService::class
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
