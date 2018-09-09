<?php

namespace Reedware\LaravelPresets\Concerns;

trait UpdatesWebpack
{
	/**
     * Update the Webpack configuration.
     *
     * @return void
     */
    public static function updateWebpackConfiguration()
    {
        static::copyStub('webpack.mix.js', base_path('webpack.mix.js'));
    }
}