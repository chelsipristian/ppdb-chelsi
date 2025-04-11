<?php

namespace App\Providers;
use Validator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alamat', function ($attribute, $value, $parameters, $validator) {
            // Contoh validasi: alamat minimal 10 karakter
            return strlen($value) >= 10;
        });
    }
}
