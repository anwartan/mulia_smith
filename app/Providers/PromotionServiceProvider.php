<?php

namespace App\Providers;

use App\Services\Contract\PromotionService;
use App\Services\Impl\PromotionServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PromotionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PromotionService::class => PromotionServiceImpl::class
    ];

    public function provides(): array
    {
        return [PromotionService::class];
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
        //
    }
}
