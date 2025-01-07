<?php

namespace App\Providers;

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
        app()->setLocale('tr');

        date_default_timezone_set('Europe/Istanbul');

        ini_set('date.timezone', 'Europe/Istanbul');

        setlocale(LC_ALL, 'tr');
    }
}
