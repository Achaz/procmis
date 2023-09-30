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
        $verticalMenuData = json_decode(
          file_get_contents(
            base_path('resources/menu/userverticalMenu.json')
          )
        );

        View::share('menuData2', [$verticalMenuData]);
    }
}
