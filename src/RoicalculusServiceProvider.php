<?php

namespace Codedhub\Roicalculus;

use Codedhub\Roicalculus\Console\Command\codedroicrun;
use Codedhub\Roicalculus\Http\Livewire\Codedroidemo;
use Database\Seeders\DatabaseSeeder;
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

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/config/codedroi.php' => config_path('codedroi.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/codedhub'),
        ], 'views');


        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('codedassets'),
        ], 'assets');

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'seeders');


        if ($this->app->runningInConsole()) {
            $this->commands([
                    codedroicrun::class,
            ]);

            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('codedhub:trade')->appendOutputTo("codedtrade.log")->everyMinute();
            });

        }

        // $seed_list[] = __DIR__ . '/database/seeders';
        // $this->loadSeeders($seed_list);





    }

    public function register()
    {


    }

    protected function loadSeeders($seed_list)
    {
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seed_list) {
            foreach ((array) $seed_list as $path) {
                $seeder->call($seed_list);
                // here goes the code that will print out in console that the migration was succesful
            }
        });
    }

}
