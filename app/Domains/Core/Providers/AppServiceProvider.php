<?php

namespace App\Domains\Core\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::environment('local')) {
            Model::preventLazyLoading();
        }

        Model::unguard();

        Collection::macro('recursive', function () {
            /** @var Collection $this */
            return $this->map(function ($value)  {
                if (is_array($value)) {
                    return collect($value)->recursive();
                }
                if ($value instanceof Collection) {
                    return $value->recursive();
                }
                return $value;  
            });
        });
    }
}
