<?php

namespace TradeInTradeUp\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // This application's existing oauth_clients table uses integer IDs.
        // Keep Passport from generating UUID client IDs so new clients remain
        // compatible with the existing schema.
        Passport::$clientUuids = false;

        // Passport registers its OAuth routes automatically in v13.
        Passport::personalAccessTokensExpireIn(now()->addDay());
    }
}
