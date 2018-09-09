<?php

namespace Reedware\LaravelPresets;

use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset;

class Reedware extends Preset
{
    use Concerns\UpdatesBlade,
        Concerns\UpdatesComposer,
        Concerns\UpdatesEvents,
        Concerns\UpdatesGitIgnore,
        Concerns\UpdatesHelpers,
        Concerns\UpdatesModels,
        Concerns\UpdatesPackages,
        Concerns\UpdatesScripts,
        Concerns\UpdatesStyles,
        Concerns\UpdatesWebpack,
        Concerns\UsesApplication,
        Concerns\UsesOutput,
        Concerns\UsesStubs;

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected static $app;

    /** 
     * The output to write messages to.
     *
     * @var \Closure
     */
    protected static $output;

	/**
	 * Installs the reedware preset.
	 *
     * @param  \Illuminate\Console\Command  $command
     *
	 * @return void
	 */
	public static function install($command)
	{
        // Make sure the application instance exists
        static::ensureApplicationInstanceExists();

        // Set the output
        static::setOutput(function($message) use ($command) {
            $command->info($message);
        });

        // Perform the steps
        static::performSteps([
            'updateGitIgnore' => 'Updating ".gitignore"',
            'updateComposer' => 'Updating "composer.json"',
            'updatePackages' => 'Updating "package.json"',
            'updateWebpackConfiguration' => 'Updating "webpack.mix.js"',
            'updateScripts' => 'Updating javascript assets',
            'updateStyles' => 'Updating css assets',
            'updateEvents' => 'Updating events',
            'updateBlade' => 'Updating blade directives',
            'updateModels' => 'Updating models',
            'updateViews' => 'Updating views',
            'updateHelpers' => 'Updating helpers',
        ]);

        static::output('Please remember to run "composer dump-autoload"!');
	}

    public static function updateViews()
    {
        File::delete(resource_path('views/welcome.blade.php'));

        static::ensureDirectoryExists(resource_path('views/layouts'));
        static::ensureDirectoryExists(resource_path('views/partials'));
        static::ensureDirectoryExists(resource_path('views/pages'));

        static::copyStub('web.blade.php', resource_path('views/layouts/web.blade.php'));
        static::copyStub('app.blade.php', resource_path('views/layouts/app.blade.php'));
        static::copyStub('page.blade.php', resource_path('views/layouts/page.blade.php'));
        static::copyStub('header.blade.php', resource_path('views/partials/header.blade.php'));
        static::copyStub('welcome.blade.php', resource_path('views/pages/welcome.blade.php'));

        static::copyStub('web.php', base_path('routes/web.php'));
    }

    /**
     * Performs the specified steps.
     *
     * @param  array  $steps
     *
     * @return void
     */
    protected static function performSteps($steps)
    {
        // Determine the total count
        $total = count($steps);

        // Initialize the index
        $index = 1;

        // Output "Applying Preset"
        static::output('Applying preset...');

        // Iterate through each step
        foreach($steps as $method => $message) {

            // Perform the step
            static::{$method}();

            // Output the message
            static::output(" - [{$index} / {$total}] {$message}");

            // Increment the index
            $index++;

        }

        // Output "Done!"
        static::output('Done!');
    }

    /**
     * Replaces the namespace within the specified filepath.
     *
     * @param  string  $path
     * @param  string  $from
     * @param  string  $to
     *
     * @return void
     */
    protected static function replaceNamespace($path, $from, $to)
    {
        $search = [
            $from . '\\',
            'namespace ' . $from . ';',
        ];

        $replace = [
            $to . '\\',
            'namespace ' . $to . ';',
        ];

        static::replaceIn($path, $search, $replace);
    }

    /**
     * Replace the given string in the given file.
     *
     * @param  string        $path
     * @param  string|array  $search
     * @param  string|array  $replace
     *
     * @return void
     */
    protected static function replaceIn($path, $search, $replace)
    {
        // Make sure the file exists
        if(!File::exists($path)) {
            return;
        }

        // Replace the search string
        File::put($path, str_replace($search, $replace, File::get($path)));
    }
}