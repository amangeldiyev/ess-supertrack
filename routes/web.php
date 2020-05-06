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

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/passengers/search', 'PassengerController@search')->middleware('auth');
Route::get('/taxi-requests/{taxiRequest}/status/{status}', 'TaxiRequestController@setStatus')->middleware('auth');
Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/confirm', 'TaxiRequestController@confirm')->name('taxi-requests.confirm')->middleware('auth');
Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/onLocation', 'TaxiRequestController@onLocation')->name('taxi-requests.onLocation')->middleware('auth');
Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/setDriver', 'TaxiRequestController@setDriver')->name('taxi-requests.setDriver')->middleware('auth');
Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/setVehicle', 'TaxiRequestController@setVehicle')->name('taxi-requests.setVehicle')->middleware('auth');

Route::resource('taxi-requests', 'TaxiRequestController')->middleware('auth');
Route::resource('users', 'OperatorController')->middleware('auth', 'admin');
Route::resource('companies', 'CompanyController')->middleware('auth', 'admin');
Route::resource('passengers', 'PassengerController')->middleware('auth');
Route::resource('drivers', 'DriverController')->middleware('auth');
Route::resource('vehicles', 'VehicleController')->middleware('auth');
