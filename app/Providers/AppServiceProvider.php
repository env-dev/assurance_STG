<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use App\Brand;
use App\BrandModel;
use App\Role;
use App\Helpers;
use App\Registration;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::component('components.modal', 'modal');
        Blade::component('components.tabs', 'tab');
        Blade::component('components.alert', 'alert');


        view()->composer('appareil.*', function ($view) {
            $view->withBrands(Brand::all());
            $view->withModels(BrandModel::all());
        });
        view()->composer('*', function ($view) {
            $view->withRoles(Role::all());
            $view->with('countNotifications',Auth::check() ? Auth::user()->unreadNotifications->count(): 0);
            $view->with('countRegistrations',Auth::check() ? Auth::user()->unreadNotifications->where('data.type','registration')->count()  : 0);
            $view->with('countSinisters',Auth::check() ? Auth::user()->unreadNotifications->where('data.type','sinister')->count()  : 0);

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
