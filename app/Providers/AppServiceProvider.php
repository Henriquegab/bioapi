<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('latitude', function ($attribute, $value, $parameters, $validator) {
            $pattern = '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/';
            return preg_match($pattern, $value);
        });

        Validator::extend('longitude', function ($attribute, $value, $parameters, $validator) {
            $pattern = '/^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/';
            return preg_match($pattern, $value);
        });
    }
}
