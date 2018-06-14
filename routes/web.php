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

    // $owner = new App\Role();
    // $owner->name         = 'owner';
    // $owner->display_name = 'Project Owner'; // optional
    // $owner->description  = 'User is the owner of a given project'; // optional
    // $owner->save();
    
    // $admin = new App\Role();
    // $admin->name         = 'admin';
    // $admin->display_name = 'User Administrator'; // optional
    // $admin->description  = 'User is allowed to manage and edit other users'; // optional
    // $admin->save();

    // $user = App\User::where('username', '=', 'adam')->first();
    // $user->attachRole($admin);


    // $createPost = new App\Permission();
    // $createPost->name         = 'create-brand';
    // $createPost->display_name = 'Create Brand'; // optional
    // // Allow a user to...
    // $createPost->description  = 'create new phone brand'; // optional
    // $createPost->save();

    // $editUser = new App\Permission();
    // $editUser->name         = 'edit-brand';
    // $editUser->display_name = 'Edit brand'; // optional
    // // Allow a user to...
    // $editUser->description  = 'edit existing brands'; // optional
    // $editUser->save();


    // $owner->attachPermissions(array($createPost, $editUser));

    // $user = App\User::where('username', '=', 'adam')->first();
    // dd($user->hasRole('owner'), $user->hasRole('admin'),$user->can('edit-brand'), $user->can('create-brand'));
  
});

Route::resource('agency', 'AgenceController');

Route::get('/appareil', function () {
    return view('appareil.main');
});
Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('brands','BrandController');
    Route::resource('models','ModelController');
    Route::resource('smartphones','SmartphoneController');
    Route::resource('agences','AgenceController');
    Route::resource('cities','CityController');
Route::group(['middleware' => ['role:admin']], function() {
    
    
});



Route::get('/get_imei', 'RegistrationController@get_imei');
Route::get('/getSmartphoneByImei/{imei}', 'RegistrationController@getSmartphoneByImei');


Route::resource('registration', 'RegistrationController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




