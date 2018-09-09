<?php

namespace Reedware\LaravelPresets\Concerns;

trait UpdatesHelpers
{
    public static function updateHelpers()
    {
        static::ensureDirectoryExists(app_path('Support'));

        $path = app_path('Support/helpers.php');

        static::copyStub('helpers.php', $path);
    }
}