<?php

namespace Siiau\ApiClient;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Siiau\ApiClient\Extensions\SiiauUserProvider;
use Siiau\ApiClient\Requests\LoginRequest;

final class SiiauApiClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'siiau');

        $this->app->singleton(
            abstract: SiiauConnector::class,
            concrete: static fn(): SiiauConnector => new SiiauConnector(
                url: config('siiau.base_url')
            ),
        );

        $this->app->resolving(
            abstract: SiiauConnector::class,
            callback: static function (SiiauConnector $connector): void {
                $connector->authenticate(new SiiauAuthenticator(new LoginRequest(
                    email: config('siiau.email'),
                    password: config('siiau.password'),
                )));
            },
        );

        $this->app['auth']->provider(
            name: 'siiau',
            callback: static fn(Application $app, array $config): UserProvider => new SiiauUserProvider(
                userProvider: $app['auth']->createUserProvider($config['decorate']),
                siiau: $app->make(SiiauConnector::class),
            ),
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('siiau.php'),
            ], 'config');
        }
    }
}
