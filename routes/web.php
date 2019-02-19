<?php

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

Route::get("/","PagesController@root")->name("root");

Route::resource('register', 'RegisterController', ['only' => ['store', 'index']]);
Route::resource('login', 'LoginController', ['only' => ['store', 'index', "destroy"]]);
Route::get("confirmEmail/{token}","RegisterController@confirmEmail")->name("register.confirmEmail")->middleware('auth:api', 'throttle:1,1');
Route::get("forgotPassword","LoginController@forgotPassword")->name("login.forgotPassword");
Route::post("sendForgotEmail","LoginController@sendForgotEmail")->name("login.sendForgotEmail");
Route::get("resetEmail/{token}","LoginController@resetEmail")->name("login.resetEmail");
Route::post("updatePassword","LoginController@updatePassword")->name("login.updatePassword");

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);


Route::group(['middleware' => ['auth']], function() {
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
    Route::get('user_addresses/create/', 'UserAddressesController@create')->name('user_addresses.create');
    Route::post('user_addresses/store', 'UserAddressesController@store')->name('user_addresses.store');
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
    Route::get('user_addresses/edit/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
});
