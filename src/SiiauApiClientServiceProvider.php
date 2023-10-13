<?php

namespace Siiau\ApiClient;

use Illuminate\Support\ServiceProvider;

final class SiiauApiClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'siiau');
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
