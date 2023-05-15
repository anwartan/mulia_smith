<?php

namespace App\Providers;

use App\Services\Contract\GoldService;
use App\Services\Impl\GoldServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GoldServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        GoldService::class => GoldServiceImpl::class
    ];

    public function provides(): array
    {
        return [GoldService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/gold.php' => config_path('gold.php'),
        ]);
    }
}
