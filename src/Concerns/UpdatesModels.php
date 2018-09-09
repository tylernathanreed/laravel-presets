<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Facades\File;

trait UpdatesModels
{
    /**
     * Updates the model files.
     *
     * @return void
     */
    public static function updateModels()
    {
        // Create "Model" directory
        if(!File::isDirectory(app_path('Models'))) {
            File::makeDirectory(app_path('Models'));
        }

        // Move "User" model to new directory
        if(File::exists(app_path('User.php'))) {
            File::move(app_path('User.php'), app_path('Models\User.php'));
        }

        // Update the namespace of the "User" model
        if(strpos(File::get(app_path('Models\User.php')), 'namespace App;') !== false) {
            static::replaceNamespace(app_path('Models\User.php'), 'App', 'App\\Models');
        }

        // Update the auth model to use the new namespace
        static::replaceIn(base_path('config\auth.php'), 'App\\User', 'App\\Models\\User');
    }
}