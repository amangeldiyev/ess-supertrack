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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('password/expired', 'Auth\PasswordExpiredController@expired')->name('password.expired');
    Route::post('password/expired', 'Auth\PasswordExpiredController@setPassword')->name('password.expired');
    Route::get('/passengers/search', 'PassengerController@search')->name('passengers.search');
    Route::get('/taxi-requests/system-notify', 'TaxiRequestController@systemNotify');
    Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/updateStatus', 'TaxiRequestController@updateStatus')->name('taxi-requests.update-status');
    Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/setDriver', 'TaxiRequestController@setDriver')->name('taxi-requests.setDriver');
    Route::match(['get', 'put'], '/taxi-requests/{taxiRequest}/setVehicle', 'TaxiRequestController@setVehicle')->name('taxi-requests.setVehicle');

    Route::middleware(['password.expired'])->group(function () {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');

        Route::match(['get', 'post'], '/passengers/import', 'PassengerController@import')->name('passengers.import');
        // Route::match(['get', 'post'], '/drivers/import', 'DriverController@import')->name('drivers.import');
        // Route::match(['get', 'post'], '/vehicles/import', 'VehicleController@import')->name('vehicles.import');
        
        Route::resource('taxi-requests', 'TaxiRequestController');
        Route::resource('users', 'OperatorController')->middleware('admin');
        Route::resource('companies', 'CompanyController')->middleware('admin');
        Route::resource('passengers', 'PassengerController');
        Route::resource('drivers', 'DriverController');
        Route::resource('vehicles', 'VehicleController');
        Route::resource('shuttles', 'ShuttleController');
    });
});
