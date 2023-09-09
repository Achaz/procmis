<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => ['auth']], function() {

    
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

Route::get('/admin', 'HomeController@index')->name('admin')->middleware('admin');
//Route::get('/', 'HomeController@index')->name('home.index')->middleware('admin');
Route::get('/superadmin', 'SuperAdminController@index')->name('superadmin')->middleware('superadmin');
Route::get('/user', 'GeneralUserController@index')->name('user')->middleware('user');
Route::get('/createCompany', 'CreateCompany@index')->name('company.create')->middleware('user');
Route::post('/createCompanyaction', 'CreateCompany@store')->name('create.submit')->middleware('user');
Route::get('/showinvitations', 'InvitationsController@index')->name('showInvitations');
Route::get('logActivity', 'HomeController@logActivity')->middleware('admin');
Route::resource('/roles', RoleController::class)->middleware('admin');
Route::resource('/permissions', PermissionsController::class)->middleware('admin');;
Route::get('/create', 'UserController@create')->name('users.create')->middleware('admin');
Route::post('/create', 'UserController@store')->name('users.store')->middleware('admin');
Route::get('/{user}/show', 'UserController@show')->name('users.show')->middleware('admin');
Route::get('/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('admin');
Route::post('/{user}/update', 'UserController@update')->name('users.update')->middleware('admin');
Route::delete('/{user}/delete', 'UserController@destroy')->name('users.destroy')->middleware('admin');
Route::get('/registercompanyuser', 'UserController@CreateCompanyUser')->name('company.createuser')->middleware('user');
Route::post('/companyuser', 'UserController@companyUser')->name('users.company')->middleware('user');

Route::get('/login',  'LoginController@show')->name('login.show');
Route::post('/login', 'LoginController@login')->name('login.perform');
Route::get('/register/request', 'RegisterController@requestInvitation')->name('requestInvitation');
Route::post('invitations', 'InvitationsController@store')->name('storeInvitation');
Route::get('register', 'RegisterController@showRegistrationForm')->name('register')->middleware('hasInvitation');



