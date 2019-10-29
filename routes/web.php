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


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('track', 'TrackController');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','checkrole'], 'roles' => ['ADMIN'] ], function () {
});

Route::group(['prefix' => 'pacd', 'middleware' => ['auth','checkrole'], 'roles' => ['PACD'] ], function () {
	Route::resource('transaction', 'TransactionController');
});