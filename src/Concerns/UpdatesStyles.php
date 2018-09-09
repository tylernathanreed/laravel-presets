<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Facades\File;

trait UpdatesStyles
{
    /**
     * Update the css style files.
     *
     * @return void
     */
    public static function updateStyles()
    {
        File::cleanDirectory(resource_path('sass'));
        File::put(resource_path('sass/app.scss'), '');
    }
}