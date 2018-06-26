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
    
    
    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/', 'DashboardController');
        Route::get('/appareil', 'HomeController@index');
        Route::resource('agency', 'AgenceController');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('brands','BrandController');
        Route::resource('models','ModelController');
        Route::resource('smartphones','SmartphoneController');
        Route::resource('agences','AgenceController');
        Route::resource('cities','CityController');
    });

    Route::get('/get_imei', 'RegistrationController@get_imei');
    Route::get('/getAgencies', 'AgenceController@getAgencies');
    Route::get('/getSmartphoneByImei/{imei}', 'RegistrationController@getSmartphoneByImei');
    Route::get('/getRegistrations', 'RegistrationController@listingRegistrations');
    Route::get('/getRegistration/{id}', 'RegistrationController@getRegistration');

    Route::resource('registration', 'RegistrationController');
    Route::get('listing-registrations', 'RegistrationController@listingRegistrations');
    Route::post('listing-new-registrations', 'RegistrationController@listingNewRegistrations');

    // Notifications

    Route::get('read-registrations', 'NotificationController@readRegisterNotifcation');
    Route::get('read-sinisters', 'NotificationController@readSinisterNotifcation');
    Route::get('read-all', 'NotificationController@readRegisterNotifcation');
    Route::post('import-smartphones', 'SmartphoneController@import');


});

Auth::routes();



Route::get('/no', function(){
//     dd(Auth::user()->unreadNotifications->where('data.type','sinister')->count());
// return Auth::user()->unreadNotifications[0]['data']['type'];
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('registration'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('registration'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('registration'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('registration'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('sinister'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('sinister'));
//      Auth::user()->notify(new \App\Notifications\NewRegistrationNotification('sinister'));

    // foreach(Auth::user()->unreadNotifications as $notification){
    //     echo $notification->data['date'];
    // }
});