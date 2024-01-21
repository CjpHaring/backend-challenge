<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Services\IHandService', 'App\Services\HandService');
        $this->app->bind('App\Interfaces\Services\ICardService', 'App\Services\CardService');
        $this->app->bind('App\Interfaces\Services\IPlayerService', 'App\Services\PlayerService');

        $this->app->bind('App\Interfaces\Repositories\IHandRepository', 'App\Repositories\HandRepository');
        $this->app->bind('App\Interfaces\Repositories\ICardRepository', 'App\Repositories\CardRepository');
        $this->app->bind('App\Interfaces\Repositories\IPlayerRepository', 'App\Repositories\PlayerRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
