<?php

namespace Reedware\LaravelPresets\Concerns;

use Closure;

trait UsesOutput
{
    /**
     * Writes the specified message to the output.
     *
     * @param  string  $message
     *
     * @return void
     */
    public static function output($message)
    {
        // Make sure the output is configed
        if(!isset(static::$output)) {
            return;
        }

        // Write to the output
        (static::$output)($message);
    }

    /**
     * Sets the output interface.
     *
     * @param  \Closure
     *
     * @return void
     */
    public static function setOutput(Closure $output)
    {
        static::$output = $output;
    }

    /**
     * Returns the output interface.
     *
     * @return \Closure|null
     */
    public static function getOutput()
    {
        return static::$output;
    }
}