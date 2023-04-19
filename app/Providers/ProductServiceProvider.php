<?php

namespace App\Providers;

use App\Services\Contract\ProductService;
use App\Services\Impl\ProductServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ProductService::class => ProductServiceImpl::class
    ];
    
    public function provides(): array
    {
        return [ProductService::class];
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
