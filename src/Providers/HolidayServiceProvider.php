<?php

namespace ShibuyaKosuke\LaravelYasumi\Providers;

use Illuminate\Support\ServiceProvider;
use ShibuyaKosuke\LaravelYasumi\Holiday;

/**
 * Class HolidayServiceProvider
 * @package ShibuyaKosuke\LaravelYasumi\Providers
 */
class HolidayServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../configs/yasumi.php', 'yasumi'
        );

        $this->publishes([
            __DIR__ . '/../configs/yasumi.php' => config_path('yasumi.php'),
        ], 'yasumi');

        $this->app->singleton('holiday', function ($app) {
            return new Holiday($app['config']);
        });
    }

    /**
     * @return void
     */
    public function boot()
    {
    }
}
