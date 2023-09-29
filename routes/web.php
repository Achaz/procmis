<?php

use App\Http\Controllers\CreateCompany;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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
Route::get('/', function () {
  return 'PROCMIS';
});

Route::group(['middleware' => ['auth']], function () {


    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('add-to-log', 'HomeController@myTestAddToLog');
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

Route::get('/user/{user}/show', 'UserController@companyusersshow')->name('companyusers.show');
Route::get('/user/{user}/edit', 'UserController@companyuseredit')->name('companyusers.edit');
Route::post('/user/{user}/update', 'UserController@update')->name('companyusers.update');
Route::delete('/user/{user}/delete', 'UserController@destroy')->name('companyusers.destroy');

Route::get('/login',  'LoginController@show')->name('login.show');
Route::post('/login', 'LoginController@login')->name('login.perform');

Route::get('register', 'RegisterController@showRegistrationForm')->name('register')->middleware('hasInvitation');
Route::get('/{company}/edit', 'CreateCompany@edit')->name('company.edit');
Route::get('/{company}/delete', 'CreateCompany@destroy')->name('company.destroy');


///company manage users
Route::group([], function () {
    Route::post("companies/{company}/users/sync", "CreateCompany@userSync")->name("company.user.sync");
    Route::post("companies/{company}/roles/sync", "CreateCompany@roleSync")->name("company.roles.sync");
    Route::get('/invitations/invite', 'RegisterController@requestInvitation')->name('requestInvitation');
    Route::post('invitations', 'InvitationsController@store')->name('storeInvitation');
    Route::get('/invitations', 'InvitationsController@index')->name('showInvitations');

    Route::get('users/activity', 'HomeController@logActivity');
    Route::get('/users', 'UserController@viewcompanyUser')->name('users.view');


    Route::get('/companies/create', 'CreateCompany@index')->name('company.create');
    Route::get('/companies', 'CreateCompany@show')->name('company.show');
    Route::post('/companies', 'CreateCompany@store')->name('company.store');
    Route::get('companies/{company}/users', 'CreateCompany@manageUser')->name('company.user.manage');

    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::get('/rolescreate', 'RoleController@create')->name('roles.create');
    Route::get('/rolesstore', 'RoleController@store')->name('roles.store');
    Route::get('/{roles}/rolesshow', 'RoleController@show')->name('roles.show');
    Route::get('/{roles}/rolesedit', 'RoleController@edit')->name('roles.edit');
    Route::get('/{roles}/rolesdestroy', 'RoleController@destroy')->name('roles.destroy');
    Route::post('/rolesupdate','RoleController@update')->name('roles.update');
    Route::get('/permissions', 'PermissionsController@index')->name('permissions.index');
    Route::get('/permissionscreate', 'PermissionsController@create')->name('permissions.create');
    Route::get('/permissionsstore', 'PermissionsController@store')->name('permissions.store');
    Route::get('/permissionsshow', 'PermissionsController@show')->name('permissions.show');
    Route::get('/permissionsedit', 'PermissionsController@edit')->name('permissions.edit');
    Route::get('/permissionsdestroy', 'PermissionsController@destroy')->name('permissions.destroy');
    Route::get('/create', 'UserController@create')->name('users.create');
    Route::post('/create', 'UserController@store')->name('users.store');
    Route::get('/{user}/show', 'UserController@show')->name('users.show');
    Route::get('/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::post('/{user}/update', 'UserController@update')->name('users.update');
    Route::delete('/{user}/delete', 'UserController@destroy')->name('users.destroy');
    Route::get('/registercompanyuser', 'UserController@CreateCompanyUser')->name('company.createuser');
    Route::post('/companyuser', 'UserController@companyUser')->name('users.company');
});

