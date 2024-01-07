<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Add Helper.php to Service Provider
 * @codeCoverageIgnore
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require base_path() . '/app/Helpers/Helper.php';
    }
}
