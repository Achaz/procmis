<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [AuthenticatedSessionController::class, 'create'])
  ->name('central.login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::name('central.')
  ->middleware(['auth'])
  ->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('invitations', 'InvitationsController@index')->name('invitations.index');
    Route::get('invitations/create', 'InvitationsController@create')->name('invitations.create');
    Route::post('invitations', 'InvitationsController@store')->name('invitations.store');

    // Auth
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
      ->name('logout');
  });


/**
 * User Routes
 */
/*
Route::group(['prefix' => 'users'], function() {

    Route::get('/createCompany', 'CreateCompany@index')->name('company.create');
});
*/
//Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
//Route::get('/', 'HomeController@index')->name('home.index');
//Route::get('/superadmin', 'SuperAdminController@index')->name('superadmin')->middleware('superadmin');
Route::get('/user', 'GeneralUserController@index')->name('user');

Route::get('register', 'RegisterController@showRegistrationForm')
  ->name('tenants.create')
  ->middleware('hasInvitation');
Route::post('register', 'RegisterController@register')
  ->name('register')
  ->middleware('hasInvitation');
Route::get('/{company}/edit', 'CreateCompany@edit')->name('company.edit');
Route::get('/{company}/delete', 'CreateCompany@destroy')->name('company.destroy');

///company manage users
Route::group([], function () {
    Route::post("companies/{company}/users/sync", "CreateCompany@userSync")->name("company.user.sync");
    Route::post("companies/{company}/roles/sync", "CreateCompany@roleSync")->name("company.roles.sync");


    Route::get('/companies/create', 'CreateCompany@index')->name('company.create');
    Route::get('/companies', 'CreateCompany@show')->name('company.show');
    Route::post('/companies', 'CreateCompany@store')->name('company.store');
    Route::get('companies/{company}/users', 'CreateCompany@manageUser')->name('company.user.manage');
});

