<?php

namespace App\Providers;

use App\Services\Implements\ReceiverServiceImplement;
use App\Services\ReceiverService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ReceiverProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ReceiverService::class => ReceiverServiceImplement::class,
    ];

    public final function provides(): array
    {
        return [
            ReceiverService::class
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
