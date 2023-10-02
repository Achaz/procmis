<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::prefix('/{tenant}')
  ->middleware([
      'web',
      InitializeTenancyByPath::class,
  ])
  ->name('tenants.')
  ->group(function () {

//    Route::get('/login',  [\App\Http\Controllers\LoginController::class, 'show'])->name('login.show');
//    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login.perform');

    Route::middleware(['auth'])->group(function () {
      Route::get('/', '\App\Http\Controllers\Tenants\DashboardController')->name('dashboard');
      Route::resource('/users', \App\Http\Controllers\Tenants\UsersController::class);
      Route::resource('/roles', \App\Http\Controllers\Tenants\RoleController::class);
    });

    require __DIR__ . '/auth.php';
});
