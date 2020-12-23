<?php

namespace App\Providers;

use App\Session\MongoSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\ConnectionInterface;



class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ConnectionInterface $connection)
    {
        Session::extend('app-mongo', function ($app) use ($connection) {
            $table   =  config('session.table');
            $minutes =  config('session.lifetime');
            return new MongoSessionHandler($connection, $table, $minutes);
        });
    }
}
