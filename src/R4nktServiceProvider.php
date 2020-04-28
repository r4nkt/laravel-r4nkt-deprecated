<?php

namespace R4nkt\Laravel;

use Illuminate\Support\ServiceProvider;
use R4nkt\PhpSdk\R4nkt;

class R4nktServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/r4nkt.php' => config_path('r4nkt.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/r4nkt.php', 'r4nkt');

        $this->app->bind('r4nkt', function() {
            return new R4nkt(config('r4nkt.api_token'), config('r4nkt.game_id'));
        });
    }
}
