<?php

namespace Softwareseni\Sso;

use Illuminate\Support\ServiceProvider;

class SsoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/sso.php' => config_path('sso.php'),
        ]);

        include __DIR__.'/routes.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Softwareseni\Sso\SsoClient');
    }
}
