<?php

namespace App\Providers;

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
//         Blade::if('admin', function () {
//             return auth()->check() && auth()->user()->admin;
//         });

//         Blade::if ('adminOrOwner', function ($id) {
//             return auth ()->check () && (auth ()->id () === $id || auth ()->user ()->admin);
//   });
    }
}
