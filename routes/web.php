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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');

Route::post('/authenticate', 'Auth\LoginController@authenticate');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/origin', 'HomeController@origin');
Route::get('/prtsc', 'HomeController@prtsc');
Route::get('/website/add', ['middleware' => ['permission:add-web', 'role:admin'], 'uses' => 'HomeController@websiteAdd']);

// Archive
Route::group(['prefix' => 'archive', 'middleware' => ['role:admin']], function() {
	Route::get('/proccess', 'ArchiveController@proccess');
	Route::get('/list-proccess', 'ArchiveController@listProccess');
	Route::get('/read/{created_at}/{url}', 'ArchiveController@readWarc');
	Route::get('/web/{created_at}', 'ArchiveController@web');
	Route::get('/pause/{id}', 'ArchiveController@pause');
	Route::get('/resume/{id}', 'ArchiveController@resume');
	
});

// Permission
Route::group(['prefix' => 'permission', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@index']);
	Route::get('/create', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@create']);
	Route::post('/store', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'PermissionController@destroy']);
});
// Role
Route::group(['prefix' => 'role', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@index']);
	Route::get('/create', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@create']);
	Route::post('/store', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'RoleController@destroy']);
});
// Role
Route::group(['prefix' => 'user', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@index']);
	Route::get('/create', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@create']);
	Route::post('/store', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@destroy']);
});