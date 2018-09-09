<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Contracts\Foundation\Application;

trait UsesApplication
{
    /**
     * Ensures that the application instance is set.
     *
     * @return void
     */
    public static function ensureApplicationInstanceExists()
    {
        if(!isset(static::$app)) {
            static::$app = Application::getInstance();
        }
    }

    /**
     * Sets the application instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application
     *
     * @return void
     */
    public static function setApplication(Application $app)
    {
        static::$app = $app;
    }

    /**
     * Returns the application instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|null
     */
    public static function getApplication()
    {
        return static::$app;
    }
}