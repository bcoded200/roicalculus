<?php

namespace Codedhub\Roicalculus;

use Codedhub\Roicalculus\Console\Command\codedroicrun;
use Codedhub\Roicalculus\Http\Livewire\Codedroidemo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class RoicalculusServiceProvider extends serviceProvider

{
    public $codedroi;

    public function boot()

    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'coded');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config/codedroi.php' => config_path('codedroi.php'),], 'config');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/codedhub'),], 'views');


        $this->publishes([
            __DIR__ . '/resources/views/livewire' => resource_path('views/livewire'),], 'livewire');


        $this->publishes([
            __DIR__.'/resources/assets' => public_path('codedassets'),], 'assets');


        if ($this->app->runningInConsole()) {
            $this->commands([
                codedroicrun::class,
            ]);

            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('codedhub:trade')->everyMinute();
            });

        }

         Livewire::component('codedroi-demo', Codedroidemo::class);



    }

    public function register()

    {


    }
}
