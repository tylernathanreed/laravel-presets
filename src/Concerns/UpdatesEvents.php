<?php

namespace Reedware\LaravelPresets\Concerns;

trait UpdatesEvents
{
	/**
	 * Updates the event service provider.
	 *
	 * @return void
	 */
    public static function updateEvents()
    {
        static::copyStub('EventServiceProvider.php', app_path('Providers/EventServiceProvider.php'));
        static::copyStub('events.php', base_path('config/events.php'));
    }
}