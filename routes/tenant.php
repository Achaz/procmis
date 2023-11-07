<?php

declare(strict_types=1);

use App\Http\Controllers\Tenants\CompanyProfileController;
use App\Http\Controllers\Tenants\BidController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use App\Http\Controllers\Tenants\ProcurementController;

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

Route::prefix('/account/{tenant}')
  ->middleware([
      'web',
      InitializeTenancyByPath::class,
      \App\Http\Middleware\ActiveTenant::class,
      \App\Http\Middleware\CheckApproved::class
  ])
  ->name('tenants.')
  ->group(function () {

    Route::get('/suppliers/create', [\App\Http\Controllers\Tenants\SupplierController::class,'create'])->name('suppliers.create');
    Route::post('/invite',[\App\Http\Controllers\Tenants\SupplyerInvitiations::class,'store'])->name('invitations.store');
    Route::get('/invitation', [\App\Http\Controllers\Tenants\SupplierController::class,'create'])->name('invitations.create');
    Route::post('/suppliers', [\App\Http\Controllers\Tenants\SupplierController::class,'store'])->name('suppliers.store');
    
    Route::middleware(['auth'])->group(function () {

      Route::get('/', '\App\Http\Controllers\Tenants\DashboardController')->name('dashboard');
      Route::get('/invite', [\App\Http\Controllers\Tenants\SupplierController::class,'invite'])->name('suppliers.invite');   
      Route::resource('/users', \App\Http\Controllers\Tenants\UsersController::class);
      Route::resource('/roles', \App\Http\Controllers\Tenants\RoleController::class);
      Route::resource('/profile', CompanyProfileController::class);
      Route::get('/bids', [\App\Http\Controllers\Tenants\BidController::class,'index'])->name('bids.index');
      Route::post('/bids', [\App\Http\Controllers\Tenants\BidController::class,'store'])->name('bids.store');
      Route::get('/bids/create', [\App\Http\Controllers\Tenants\BidController::class,'create'])->name('bids.create');
      Route::delete('/bids/{bid}/delete',[\App\Http\Controllers\Tenants\BidController::class,'destroy'])->name('bids.destroy');
      Route::get('/bids/{bid}/edit',[\App\Http\Controllers\Tenants\BidController::class,'edit'])->name('bids.edit');
      Route::post('/bids/{bid}/update',[\App\Http\Controllers\Tenants\BidController::class,'update'])->name('bids.update');
      Route::get('/bids/download/{bid}', [\App\Http\Controllers\Tenants\BidController::class, 'downloadFile'])->name('bids.download');

      Route::get('/suppliers', [\App\Http\Controllers\Tenants\SupplierController::class,'index'])->name('suppliers.index');
      
      
      Route::delete('/suppliers/{supplier}/delete',[\App\Http\Controllers\Tenants\SupplierController::class,'destroy'])->name('suppliers.destroy');
      Route::get('/suppliers/{supplier}/edit',[\App\Http\Controllers\Tenants\SupplierController::class,'edit'])->name('suppliers.edit');
      Route::post('/suppliers/{supplier}/update',[\App\Http\Controllers\Tenants\SupplierController::class,'update'])->name('suppliers.update');

      Route::get('/procurement', [\App\Http\Controllers\Tenants\ProcurementController::class,'index'])->name('procurement.index');
      Route::get('/procurement/create', [\App\Http\Controllers\Tenants\ProcurementController::class,'create'])->name('procurement.create');
      Route::post('/procurement', [\App\Http\Controllers\Tenants\ProcurementController::class,'store'])->name('procurement.store');
      Route::get('/procurement/{procurementplan}/edit', [\App\Http\Controllers\Tenants\ProcurementController::class,'edit'])->name('procurement.edit');
      Route::delete('/procurement/{procurementplan}/delete', [\App\Http\Controllers\Tenants\ProcurementController::class,'destroy'])->name('procurement.destroy');
      Route::post('/procurement/{procurementplan}/update', [\App\Http\Controllers\Tenants\ProcurementController::class,'update'])->name('procurement.update');
      Route::get('/procurement/download/{procurementplan}', [\App\Http\Controllers\Tenants\ProcurementController::class, 'downloadFile'])->name('procurement.download');
    });

    require __DIR__ . '/auth.php';
});
