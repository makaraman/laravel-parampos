<?php

namespace Makaraman\Parampos\Providers;

use Illuminate\Support\ServiceProvider;

class ParamposServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Configs
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'parampos');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            // Publish config file with --tag=config
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('parampos.php'),
            ], 'config');
        }
    }
}
