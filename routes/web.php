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
Route::view('/table', 'table');
Route::view('/form', 'form');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('requests', 'RequestController');
Route::resource('companies', 'CompanyController');
Route::resource('passengers', 'PassengerController');
Route::resource('drivers', 'DriverController');
Route::resource('vehicles', 'VehicleController');
