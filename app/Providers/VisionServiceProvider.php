<?php

namespace App\Providers;

use App\Support\Vision;
use Illuminate\Support\ServiceProvider;

class VisionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('vision', Vision::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
