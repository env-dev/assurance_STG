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

Route::group(['middleware' => ['auth']], function() {
    
    Route::get('/', function(){
        return view('index');
    });
    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/dashboard', 'DashboardController');
        Route::get('/statistics', 'DashboardController@statistics');
        Route::get('/appareil', 'HomeController@index');
        Route::resource('agency', 'AgenceController');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('brands','BrandController');
        Route::resource('models','ModelController');
        Route::resource('smartphones','SmartphoneController');
        Route::post('import-smartphones', 'SmartphoneController@import');
        Route::resource('agences','AgenceController');
        Route::resource('cities','CityController');
    });

    Route::get('/get_imei', 'RegistrationController@get_imei');
    Route::get('/getAgencies', 'AgenceController@getAgencies');
    Route::get('/getSmartphoneByImei/{imei}', 'RegistrationController@getSmartphoneByImei');
    Route::get('/getRegistrations', 'RegistrationController@listingRegistrations');
    Route::get('/getRegistration/{id}', 'RegistrationController@getRegistration');
    Route::get('/check-status/{id}', 'RegistrationController@checkStatus');
    Route::get('/export-registrations', 'RegistrationController@export');
    
    Route::resource('registration', 'RegistrationController');
    Route::resource('avenants', 'AvenantController');
    Route::get('listing-registrations', 'RegistrationController@listingRegistrations');
    Route::post('listing-new-registrations', 'RegistrationController@listingNewRegistrations');
    
    Route::get('getAvenants', 'AvenantController@listingAvenants');
    Route::get('/getAvenant/{id}', 'AvenantController@getAvenant');
    Route::get('listing-avenants', 'AvenantController@listingAvenants');
    Route::get('export-avenants', 'AvenantController@export');

    Route::resource('claims', 'claimController');
    Route::get('listing-claims', 'claimController@listingclaims');
    Route::post('listing-new-claims', 'claimController@listingNewclaims');
    // Notifications
    Route::get('read-registrations', 'NotificationController@readRegisterNotifcation');
    Route::get('read-sinisters', 'NotificationController@readSinisterNotifcation');
    Route::get('read-all', 'NotificationController@readRegisterNotifcation');

});

Auth::routes();


Route::get('/no', function(){

});