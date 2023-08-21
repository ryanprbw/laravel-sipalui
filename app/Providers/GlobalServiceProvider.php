<?php

namespace App\Providers;

use App\Services\AssistanceService;
use App\Services\GovernmentService;
use App\Services\Implements\AssistanceServiceImplement;
use App\Services\Implements\GovernmentServiceImplement;
use App\Services\Implements\ReferenceServiceImplement;
use App\Services\Implements\UserServiceImplement;
use App\Services\Implements\UtilityServiceImplement;
use App\Services\ReferenceService;
use App\Services\UserService;
use App\Services\UtilityService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GlobalServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        UserService::class => UserServiceImplement::class,
        AssistanceService::class => AssistanceServiceImplement::class,
        ReferenceService::class => ReferenceServiceImplement::class,
        UtilityService::class => UtilityServiceImplement::class,
        GovernmentService::class => GovernmentServiceImplement::class
    ];

    public final function provides(): array
    {
        return [
            UserService::class,
            AssistanceService::class,
            ReferenceService::class,
            UtilityService::class,
            GovernmentService::class
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
