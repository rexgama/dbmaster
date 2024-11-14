<?php

namespace Rexgama\DBMaster;

use Illuminate\Support\ServiceProvider;
use Rexgama\DBMaster\Commands\InstallCommand;

class DBMasterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'dbmaster');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/config/dbmaster.php' => config_path('dbmaster.php'),
            __DIR__ . '/resources/views' => resource_path('views/vendor/dbmaster'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/dbmaster.php', 'dbmaster'
        );
    }
}