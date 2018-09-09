<?php

namespace Reedware\LaravelPresets\Concerns;

trait UpdatesComposer
{
    /**
     * Adds a helper file to the support directory.
     *
     * @return void
     */
    public static function updateComposer()
    {
        if(!file_exists(base_path('composer.json'))) {
            return;
        }

        $configuration = json_decode(file_get_contents(base_path('composer.json')), true);

        $configuration = static::updateComposerArray($configuration);

        file_put_contents(
            base_path('composer.json'),
            json_encode($configuration, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Updates the specified composer array.
     *
     * @param  array  $config
     */
    public static function updateComposerArray($config)
    {
        if(!isset($config['autoload']['files'])) {
            $config['autoload']['files'] = [];
        }

        if(!in_array('app/Support/helpers.php', $config['autoload']['files'])) {
            $config['autoload']['files'][] = 'app/Support/helpers.php';
        }

        ksort($config['autoload']['files']);

        return $config;
    }
}