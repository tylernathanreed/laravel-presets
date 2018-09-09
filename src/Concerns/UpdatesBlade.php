<?php

namespace Reedware\LaravelPresets\Concerns;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

trait UpdatesBlade
{
	/**
	 * Updates the blade directives.
	 *
	 * @return void
	 */
    public static function updateBlade()
    {
        static::copyStub('BladeServiceProvider.php', app_path('Providers/BladeServiceProvider.php'));

        $path = base_path('config/app.php');

        if(strpos(File::get($path), 'BladeServiceProvider') == false) {
            static::replaceIn($path, 'App\\Providers\\AuthServiceProvider::class,', "App\\Providers\\AuthServiceProvider::class,\n        App\\Providers\\BladeServiceProvider::class,");
        }

        Artisan::call('view:clear');
    }
}