<?php

namespace Reedware\LaravelPresets;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset;

class Reedware extends Preset
{
	/**
	 * Installs the reedware preset.
	 *
	 * @return void
	 */
	public static function install()
	{
		static::updatePackages();
		static::updateWebpackConfiguration();
        static::updateScripts();
		static::updateStyles();
	}

	/** 
	 * Updates the "packages.json" file for the project.
	 *
	 * @param  array  $packages  The current list of packages.
	 *
	 * @return array
	 */
	public static function updatePackageArray($packages)
	{
		return array_merge(
			static::getPackagesToInclude(),
			Arr::except($packages, static::getPackagesToRemove())
		);
	}

	/**
	 * Returns the packages to include.
	 *
	 * @return array
	 */
	public static function getPackagesToInclude()
	{
		return [
			'laravel-mix-tailwind' => '^0.1.0'
		];
	}

	/**
	 * Returns the packages to remove.
	 *
	 * @return array
	 */
	public static function getPackagesToRemove()
	{
		return [
			'popper.js',
			'lodash',
			'jquery',
			'bootstrap',
            'babel-preset-react',
            'react',
            'react-dom',
		];
	}

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    public static function updateWebpackConfiguration()
    {
        static::copyStub('webpack.mix.js', base_path('webpack.mix.js'));
    }

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

    /**
     * Update the css style files.
     *
     * @return void
     */
    public static function updateStyles()
    {
        File::cleanDirectory(resource_path('assets/sass'));
        File::put(resource_path('assets/sass/app.scss'), '');
    }

    /**
     * Copies the specified stub to the given destination.
     *
     * @param  string  $stub
     * @param  string  $destination
     *
     * @return void
     */
    protected static function copyStub($stub, $destination)
    {
    	copy(__DIR__ . "/stubs/{$stub}", $destination);
    }
}