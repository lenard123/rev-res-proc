<?php

namespace Enterprisesuite\DomainDriven\Providers;

use Enterprisesuite\DomainDriven\Console\DomainActionMakeCommand;
use Enterprisesuite\DomainDriven\Console\DomainModelMakeCommand;
use Illuminate\Support\ServiceProvider;

class DomainDrivenServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DomainModelMakeCommand::class,
                DomainActionMakeCommand::class,
            ]);
        }
    }
}