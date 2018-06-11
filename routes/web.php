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
    return App\Brand::all();
    // Comment
    // dfdsfdsf
});

Route::get('/appareil', function () {
    return view('appareil.main');
});
Route::get('/get_imei', 'RegistrationController@get_imei');
Route::get('/getSmartphoneByImei/{imei}', 'RegistrationController@getSmartphoneByImei');
Route::get("download-pdf","RegistrationController@downloadPDF");

Route::resource('brands','BrandController');
Route::resource('models','ModelController');
Route::resource('registration', 'RegistrationController');
