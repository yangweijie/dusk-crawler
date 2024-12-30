<?php

namespace DuskCrawler;

use Illuminate\Console\Application as Artisan;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

class DuskServiceProvider extends ServiceProvider
{
    use Concerns\RegisterMacros;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBrowserMacros();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Browser::$storeScreenshotsAt = \storage_path('app/Browser/screenshots');
        Browser::$storeConsoleLogAt = \storage_path('logs');

        if ($this->app->runningInConsole()) {
            Artisan::starting(static function ($artisan) {
                $artisan->add(new Console\InstallCommand());
            });
        }
    }
}
