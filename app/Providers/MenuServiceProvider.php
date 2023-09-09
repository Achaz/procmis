<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
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
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    //$verticalMenuJson2 = file_get_contents(base_path('resources/menu/userverticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    //$verticalMenuData2 = json_decode($verticalMenuJson2);

    // Share all menuData to all the views
    View::share('menuData',[$verticalMenuData]);
  }
}
