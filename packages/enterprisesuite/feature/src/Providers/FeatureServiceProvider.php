<?php

namespace Enterprisesuite\Feature\Providers;

use Enterprisesuite\Feature\FeatureManager;
use Illuminate\Support\ServiceProvider;

class FeatureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/feature.php', 'feature');

        $this->app->singleton(FeatureManager::class, function ($app) {
            return new FeatureManager(
                config('feature')
            );
        });

    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/feature.php' => config_path('feature.php'),
        ], 'feature-config');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}