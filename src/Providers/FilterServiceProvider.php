<?php

namespace Filter\Providers;

use Filter\Commands\GenerateFilter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->commands([
               GenerateFilter::class
            ]);
        }
        if(File::exists($file = __DIR__ . '/../helpers.php'))
            require_once $file;
    }
}
