<?php

namespace TradeInTradeUp\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Preserve the Bootstrap 4 pagination markup used by this application.
        Paginator::useBootstrapFour();

        Schema::defaultStringLength(191); //This has been added (good across OS). Fixes error with string length.
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
