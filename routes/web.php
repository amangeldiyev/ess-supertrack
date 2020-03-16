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

Route::view('/home', 'concept.home')->name('home')->middleware('auth');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/passengers/search', 'PassengerController@search')->middleware('auth');

Route::resource('taxi-requests', 'TaxiRequestController')->middleware('auth');
Route::resource('users', 'OperatorController')->middleware('auth', 'admin');
Route::resource('companies', 'CompanyController')->middleware('auth', 'admin');
Route::resource('passengers', 'PassengerController')->middleware('auth');
Route::resource('drivers', 'DriverController')->middleware('auth');
Route::resource('vehicles', 'VehicleController')->middleware('auth');
