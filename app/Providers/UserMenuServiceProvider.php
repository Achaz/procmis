<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class UserMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/userverticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
        View::share('menuData2',[$verticalMenuData]);

    }
}
