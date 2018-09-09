<?php

namespace Reedware\LaravelPresets\Concerns;

trait UpdatesScripts
{
    /**
     * Update the java script files.
     *
     * @return void
     */
    public static function updateScripts()
    {
        static::updateJavaScriptBase();
        static::updateJavaScriptBootstrapping();
    }

    /**
     * Update the javascript app file.
     *
     * @return void
     */
    public static function updateJavaScriptBase()
    {
        static::copyStub('app.js', resource_path('js/app.js'));
    }

    /**
     * Update the javascript bootstrap file.
     *
     * @return void
     */
    public static function updateJavaScriptBootstrapping()
    {
        static::copyStub('bootstrap.js', resource_path('js/bootstrap.js'));
    }
}