<?php

namespace MCris112\Billable;

use Illuminate\Support\ServiceProvider;

class BillableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
//        $this->app->tag();

        $this->registerMigrations();

        $this->registerPublishing();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/billable.php', 'billable'
        );
    }

    protected function registerMigrations(): void
    {
        if(!$this->app->runningInConsole()) return;
        $this->loadMigrationsFrom( dirname(__DIR__) . '/database/migrations' );
    }
    protected function registerPublishing()
    {
        if(!$this->app->runningInConsole()) return;

        $this->publishes([
            dirname(__DIR__) . '/config/billable.php' => $this->app->configPath('billable.php'),
        ], 'billable.config');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations' => $this->app->databasePath('migrations')
        ], 'billable.migrations');
    }

}
