<?php

namespace Enterprisesuite\DbBackup\Providers;

use Illuminate\Support\ServiceProvider;

class DbBackupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/db-backup.php', 'db-backup');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Enterprisesuite\DbBackup\Console\DbBackupCommand::class,
            ]);
        }
    }
}