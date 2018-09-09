<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Facades\File;

trait UpdatesGitIgnore
{
    /**
     * Updates the ".gitignore" file.
     *
     * @return void
     */
    public static function updateGitIgnore()
    {
        $path = base_path('.gitignore');

        if(strpos(File::get($path), '.sublime-project') === false) {
            File::append($path, "\n_.sublime-project\n");
        }

        if(strpos(File::get($path), '.sublime-workspace') === false) {
            File::append($path, "\n_.sublime-workspace\n");
        }

        static::replaceIn($path, "\n\n", "\n");
    }
}