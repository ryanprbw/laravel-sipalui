<?php

namespace App\Providers;

use App\Services\BudgetService;
use App\Services\Implements\BudgetServiceImplement;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BudgetProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        BudgetService::class => BudgetServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            BudgetService::class
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
