<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use App\Brand;
use App\BrandModel;
use App\Role;
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
