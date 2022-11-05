<?php

namespace MelhorEnvio;

use Illuminate\Support\ServiceProvider;

class MelhorEnvioServiceProvider extends ServiceProvider
{
    public function register()
    {
       
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'melhorenvio');
        if (!method_exists($this->app, 'routesAreCached')) {
            require __DIR__.'/routes.php';

            return; // lumen
        }

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->publishes(
            [
                __DIR__.'/Config.php' => config_path('melhorenvio.php'),
            ],
            'config'
        );
    }
}
