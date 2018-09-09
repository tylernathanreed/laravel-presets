<?php

namespace Reedware\LaravelPresets;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class LaravelPresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('reedware', function($command) {

            // Set the application instance
            Reedware::setApplication($this->app);

            // Install the preset
            Reedware::install($command);

        });
    }
}
