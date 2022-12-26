<?php

namespace Codedhub\Roicalculus;

use Illuminate\Support\ServiceProvider;

class RoicalculusServiceProvider extends serviceProvider

{

    public function boot()

    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'coded');
    }

    public function register()

    {
    }
}
