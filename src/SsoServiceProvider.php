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
