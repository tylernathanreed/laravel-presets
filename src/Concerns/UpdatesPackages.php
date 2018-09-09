<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Arr;

trait UpdatesPackages
{
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
}