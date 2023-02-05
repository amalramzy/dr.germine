<?php

namespace App\Providers;

use App\Models\Vaccination;
use Illuminate\Support\ServiceProvider;
use App\Observers\DaysObserver;

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
        // Schema::defultStringLength(191);

        Vaccination::observe(DaysObserver::class);
    }
}
