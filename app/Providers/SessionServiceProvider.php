<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Session\Middleware\StartSession;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //return new StartSession();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->register(StartSession::class);
    }
}
