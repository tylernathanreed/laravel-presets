<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
    	// Register the blade directives
    	$this->registerBladeDirectives();
	}

	/**
	 * Registers the blade directives.
	 *
	 * @return void
	 */
	protected function registerBladeDirectives()
	{
	    // Determine all class methods
	    $methods = get_class_methods(static::class);

	    // Only use methods that start with "compile" and a capital letter
	    $filter = array_filter($methods, function($method) {
	        return starts_with($method, 'compile') && substr($method, 7, 1) === strtoupper(substr($method, 7, 1));
	    });

	    // Call each method
	    foreach($filter as $method) {
	        $this->$method();
	    }
	}
	
	/**
	 * Addds the @optional and @endoptional directives.
	 *
	 * @return void
	 */
	protected function compileOptional()
	{
		Blade::directive('optional', function($expression) {
			return "<?php if(trim(\$__env->yieldContent({$expression}))): ?>";
		});

		Blade::directive('endoptional', function($expression) {
			return "<?php endif; ?>";
		});
	}

	/**
	 * Adds the @choice directive.
	 *
	 * @return void
	 */
	protected function compileChoice()
	{
		Blade::directive('choice', function($expression) {
			return "<?php echo trans_choice({$expression}) ?>";
		});
	}

	/**
	 * Adds the @tooltip directive.
	 *
	 * @return void
	 */
	protected function compileTooltip()
	{
	    Blade::directive('tooltip', function($expression) {
			return "<?php echo tooltip({$expression}) ?>";
		});
	}

	/**
	 * Adds the @popover directive.
	 *
	 * @return void
	 */
	protected function compilePopover()
	{
	    Blade::directive('popover', function($expression) {
			return "<?php echo popover({$expression}) ?>";
		});
	}
}