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

Route::view('/', 'welcome');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/passengers/search', 'PassengerController@search');

Route::resource('taxi-requests', 'TaxiRequestController');
Route::resource('companies', 'CompanyController');
Route::resource('passengers', 'PassengerController');
Route::resource('drivers', 'DriverController');
Route::resource('vehicles', 'VehicleController');
