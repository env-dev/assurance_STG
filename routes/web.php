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
    Route::get('/', 'DashboardController');
    

    Route::group(['middleware' => ['role:admin']], function() {
        
        Route::get('/appareil', function () {
            return view('appareil.main');
        });
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
});


Route::get('/get_imei', 'RegistrationController@get_imei');
Route::get('/getSmartphoneByImei/{imei}', 'RegistrationController@getSmartphoneByImei');


Route::resource('registration', 'RegistrationController');
Route::get('listing-registrations', 'RegistrationController@listingRegistrations');
Route::post('listing-new-registrations', 'RegistrationController@listingNewRegistrations');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');




