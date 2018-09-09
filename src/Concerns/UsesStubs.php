<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Facades\File;

trait UsesStubs
{
    /**
     * Copies the specified stub to the given destination.
     *
     * @param  string   $stub
     * @param  string   $destination
     * @param  boolean  $overwrite
     *
     * @return void
     */
    protected static function copyStub($stub, $destination, $overwrite = true)
    {
        if(!$overwrite && File::exists($destination)) {
            return;
        }

    	File::copy(static::getStubsDirectory() . $stub, $destination);
    }

    /**
     * Returns the stubs directory.
     *
     * @return string
     */
    public static function getStubsDirectory()
    {
        return __DIR__ . '/../stubs/';
    }

    /**
     * Ensures the specified directory exists.
     *
     * @return void
     */
    protected static function ensureDirectoryExists($path)
    {
        if(!File::isDirectory($path)) {
            File::makeDirectory($path);
        }
    }
}