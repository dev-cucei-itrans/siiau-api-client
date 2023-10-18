<?php

namespace Siiau\ApiClient;

use Illuminate\Support\ServiceProvider;
use Siiau\ApiClient\Requests\LoginRequest;

final class SiiauApiClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'siiau');

        $this->app->singleton(
            abstract: SiiauConnector::class,
            concrete: static function (): SiiauConnector {
                $connector = new SiiauConnector(url: config('siiau.base_url'));

                $connector->authenticate(new SiiauAuthenticator(new LoginRequest(
                    email: config('siiau.email'),
                    password: config('siiau.password'),
                )));

                return $connector;
            }
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
