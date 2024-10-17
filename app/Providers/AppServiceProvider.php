<?php

namespace App\Providers;

use App\Models\City;
use App\Models\District;
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
        $cities = City::all();
        $districts = District::all();
        view()->share([
            'cities' => $cities,
            'districts' => $districts
        ]);
    }
}
