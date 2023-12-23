<?php

namespace App\Providers;

use App\Domains\Auth\OAuthGrants\LoggedInGrant;
use App\Domains\Auth\OAuthGrants\SocialGrant;
use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Bridge\RefreshTokenRepository;

/**
 * Class OAuthServiceProvider.
 */
class OAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend(AuthorizationServer::class, function ($server, $app) {
            return tap($server, function ($server) {
                $server->enableGrantType(
                    $this->makeLoggedInRequestGrant(),
                    Passport::tokensExpireIn()
                );

                $server->enableGrantType(
                    $this->makeSocialGrant(),
                    Passport::tokensExpireIn()
                );
            });
        });
    }

    /**
     * @return LoggedInGrant
     * @throws BindingResolutionException
     *
     */
    protected function makeLoggedInRequestGrant()
    {
        $grant = new LoggedInGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }

    /**
     * Create and configure an instance of Social Grant.
     */
    protected function makeSocialGrant(): SocialGrant
    {
        $grant = new SocialGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
