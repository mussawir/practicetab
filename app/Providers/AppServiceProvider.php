<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('old_pass_vld', function ($attribute, $value, $parameters, $validator) {

            return \Hash::check($value, current($parameters));

        });

        // custom blade directive
        \Blade::directive('truncate', function($expression){
            list($string, $length) = explode(',',str_replace(['(',')',' '], '', $expression));

            // e() function is a helper function Laravel, essentially a synonym for htmlentities().
            // We do not want in our case that directive @truncate returned raw html, so we use the e().
            return "<?php echo e(strlen({$string}) > {$length} ? substr({$string},0,{$length}).'...' : {$string}); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
