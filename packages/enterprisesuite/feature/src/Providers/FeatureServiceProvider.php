<?php

namespace Enterprisesuite\Feature\Providers;

use Illuminate\Support\ServiceProvider;

class FeatureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/feature.php', 'feature');
        $this->publishes([
            __DIR__ . '/../config/feature.php' => config_path('feature.php'),
        ], 'feature-config');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}