<?php

namespace Bigmom\Health\Providers;

use Bigmom\Health\Commands\HealthCheckMakeCommand;
use Bigmom\Health\Commands\HealthHandlerMakeCommand;
use Bigmom\Health\Commands\RunHealthCheck as CommandsRunHealthCheck;
use Bigmom\Health\Contracts\HealthCheckJob;
use Bigmom\Health\Events\HealthCheckFailed;
use Bigmom\Health\Events\HealthCheckSuccessful;
use Bigmom\Health\Jobs\RunHealthCheck;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HealthCheckJob::class, function ($app, array $args) {
            $check = $args[0];
            $handlers = $args[1];
            return new RunHealthCheck($check, $handlers);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/health.php' => config_path('health.php'),
            ], 'config');

            $this->commands([
                HealthCheckMakeCommand::class,
                HealthHandlerMakeCommand::class,
                CommandsRunHealthCheck::class
            ]);
        }

        if (config('health.register-events')) {
            Event::listen(function (HealthCheckSuccessful $evt) {});
            Event::listen(function (HealthCheckFailed $evt) {});
        }
    }
}
