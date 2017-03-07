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

Route::get('/', function () {
    return view('index');
});
Route::group(['prefix' => 'api'], function() {
	Route::get('users/{user?}', 'UsersController@index');
	Route::post('users', 'UsersController@store');
	Route::post('users/{id}', 'UsersController@update');
	Route::get('users/destroy/{id}', 'UsersController@destroy');
	Route::post('image', 'UsersController@uploadImage');
});
		
