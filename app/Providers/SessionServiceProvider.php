<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Extensions\DatabaseSessionHandler;
use Illuminate\Support\Facades\Session;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Session::extend('db_table', function ($app) {
            return new DatabaseSessionHandler($this->getDefaultConnection(), config('session.table'), config('session.lifetime'), $app);
        });
    }

    protected function getDefaultConnection()
    {
        return $this->app->make('db')->connection(config('session.connection'));
    }
}
