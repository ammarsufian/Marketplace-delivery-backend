<?php

namespace App\Providers;

use App\Rules\RulesBus;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Rules', function () {
            return new RulesBus();
        });
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
