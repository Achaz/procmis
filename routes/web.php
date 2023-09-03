<?php

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


Route::group(['middleware' => ['auth']], function() {

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('add-to-log', 'HomeController@myTestAddToLog');
    Route::get('logActivity', 'HomeController@logActivity');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionsController::class);
    Route::get('/showinvitations', 'InvitationsController@index')->name('showInvitations');
});

/**
 * User Routes
 */
Route::group(['prefix' => 'users'], function() {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/create', 'UserController@create')->name('users.create');
    Route::post('/create', 'UserController@store')->name('users.store');
    Route::get('/{user}/show', 'UserController@show')->name('users.show');
    Route::get('/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::post('/{user}/update', 'UserController@update')->name('users.update');
    Route::delete('/{user}/delete', 'UserController@destroy')->name('users.destroy');
    Route::get('/units', 'UserController@units')->name('users.units');
});

Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    //Route::get('/register', 'UserController@create')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');
    
    /**
     * Login Routes
     */
    //Route::get('/dlr',[DashboardController::class,'bulksmsdeliveryreports']);
    //Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::get('/login',  'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login.perform');

});
Route::get('/register/request', 'RegisterController@requestInvitation')->name('requestInvitation');
Route::post('invitations', 'InvitationsController@store')->name('storeInvitation');
Route::get('register', 'RegisterController@showRegistrationForm')->name('register')->middleware('hasInvitation');


