<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Fluent;
use Symfony\Component\Finder\Finder;

if(!function_exists('carbon')) {

    /**
     * Performs Carbon::parse() on the specified date.
     *
     * @param  mixed  $date
     *
     * @return \Carbon\Carbon
     */
    function carbon($date = 'now')
    {
        return Carbon::parse($date);
    }
}

if(!function_exists('ddl')) {

    /**
     * Performs a die-and-dump while including the file and line number.
     *
     * @return void
     */
    function ddl()
    {
        // Perform a backtrace
        [$one, $caller] = debug_backtrace(false, 2);

        // Dump the file and line number
        dump("{$caller['file']}:{$caller['line']}");

        // Determine the arguments
        $args = func_get_args();

        // Perform the die-and-dump
        dd(...$args);
    }

}


if(!function_exists('file_upload_max_size')) {

    /**
     * Returns the file size limit in kilobytes based on the php ini settings.
     *
     * @return integer
     */
    function file_upload_max_size()
    {
        // Determine post_max_size
        $post_max = kilobytes(ini_get('post_max_size'));

        // Determine the upload_max_filesize
        $upload_max = kilobytes(ini_get('upload_max_filesize'));

        // If upload_max is greater than zero, then return the minimum
        if($upload_max > 0) {
            return min($post_max, $upload_max);
        }

        // Return the post max
        return $post_max;
    }

}

if(!function_exists('finder')) {

    /**
     * Creates and returns a new finder instance.
     *
     * @return \Symfony\Component\Finder\Finder
     */
    function finder()
    {
        return new Finder;
    }
}

if(!function_exists('fluent')) {

    /**
     * Creates and returns a new fluent using the specified Attributes.
     *
     * @param  mixed  $attributes
     *
     * @return \Illuminate\Support\Fluent
     */
    function fluent($attributes = [])
    {
        // Normalize the attributes
        if(is_object($attributes) && method_exists($attributes, 'toArray')) {
            $attributes = $attributes->toArray();
        }

        // Create and return a new fluent
        return new Fluent($attributes);
    }

}

if(!function_exists('get_protected'))
{
    /**
     * Returns the value of the specified protected attribute from the specified object.
     *
     * @param  mixed   $object
     * @param  string  $property
     *
     * @return mixed
     */
    function get_protected($object, $property)
    {
        // Determine reflection class
        $reflection = new ReflectionClass($object);

        // Determine reflective property
        $property = $reflection->getProperty($property);

        // Make the protected property accessible
        $property->setAccessible(true);

        // Return the property value
        return $property->getValue($object);
    }

}

if(!function_exists('kilobytes')) {

    /**
     * Converts the specified amount into kilobytes.
     *
     * @param  string  $amount  The specified amount (Ex: "1M", "2.5G", etc.)
     *
     * @return integer
     */
    function kilobytes($amount)
    {
        // Determine the unit and size
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $amount); // Remove the non-unit characters from the amount
        $size = preg_replace('/[^0-9\.]/', '', $amount); // Remove the non-numeric characters from the amount

        // If no unit was found, then return the size
        if(empty($unit)) {
            return intval($size);
        }

        // Multiply the size by the unit in kilobytes
        return intval($size * pow(1024, stripos('bkmgtpezy', $unit[0]) - 1)); 
    }

}

if(!function_exists('preg_first')) {

    /**
     * Returns the first match in the specified regular expression.
     *
     * @param  string   $pattern
     * @param  string   $subject
     * @param  integer  $flags
     * @param  integer  $offset
     *
     * @return string
     */
    function preg_first($pattern, $subject, $flags = 0, $offset = 0)
    {
        $matches = [];

        preg_match($pattern, $subject, $matches, $flags, $offset);

        return head($matches);
    }

}

if(!function_exists('seed')) {

    /**
     * Runs the specified database seeder.
     *
     * @param  string  $seeder
     *
     * @return void
     */
    function seed($seeder)
    {
        return app()->make($seeder)->run();
    }

}

if(!function_exists('snake_case')) {

    /**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     *
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        return str_replace(['-', '_'], $delimiter, Str::snake($value, $delimiter));
    }

}

if(!function_exists('spinal_case')) {

    /**
     * Converts the given string to spinal-case.
     *
     * @param  string  $string
     *
     * @return  string
     */
    function spinal_case($string)
    {
        return str_replace('_', '-', snake_case($string));
    }

}

if(!function_exists('str_words')) {

    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     *
     * @return string
     */
    function str_words($value, $words = 100, $end = '...')
    {
        return Str::words($value, $words, $end);
    }
}

if(!function_exists('studly_snake')) {

    /**
     * Converts the given string to Studly_Snake case.
     *
     * @param  string  $string
     *
     * @return string
     */
    function studly_snake($string)
    {
        // Determine the studly pieces
        $pieces = explode('.', $string);

        // Convert the pieces to studly case
        $pieces = array_map(function($piece) { 
            return studly_case($piece);
        }, $pieces);

        // Join the pieces in a snake-like fashion
        return implode('_', $pieces);
    }

}

if(!function_exists('tooltip')) {

    /**
     * Returns the HTML for the specified tool-tip.
     *
     * @param  string  $snippet
     * @param  string  $tooltip
     * @param  string  $placement
     *
     * @return string
     */
    function tooltip($snippet, $tooltip, $placement = 'bottom')
    {
        return "<abbr data-html=\"true\" data-toggle=\"tooltip\" data-placement=\"{$placement}\" title=\"{$tooltip}\">{$snippet}</abbr>";
    }

}

if(!function_exists('popover')) {

    /**
     * Returns the HTML for the specified popover.
     *
     * @param  string  $title
     * @param  string  $content
     * @param  string  $placement
     * @param  string  $trigger
     *
     * @return string
     */
    function popover($snippet, $title, $content, $placement = 'right', $trigger = 'hover')
    {
        return "<abbr data-html=\"true\" data-toggle=\"popover\" data-placement=\"{$placement}\" title=\"{$title}\" data-content=\"{$content}\" data-trigger=\"{$trigger}\">{$snippet}</abbr>";
    }

}

if(!function_exists('yes_no')) {

    /**
     * Return pretty "Yes" or "No" values based on the truthiness of a given variable.
     *
     * @param  mixed  $value
     *
     * @return string
     */
    function yes_no($value)
    {
        return $value && strtolower($value) !== 'false' ? 'Yes' : 'No';
    }

}