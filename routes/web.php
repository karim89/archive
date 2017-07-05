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
// Route::get('/website/add', ['middleware' => ['permission:website-manager', 'role:admin'], 'uses' => 'HomeController@websiteAdd']);
Route::get('/profile', 'UserController@profile');
Route::post('/save-avatar', 'UserController@saveAvatar');
Route::get('/change-password', 'UserController@changePassword');
Route::post('/save-password', 'UserController@savePassword');

// Archive
Route::group(['prefix' => 'archive', 'middleware' => ['role:admin']], function() {
	Route::get('/proccess', 'ArchiveController@proccess');
	Route::get('/read/{created_at}/{url}', 'ArchiveController@readWarc');
	Route::get('/web/{created_at}', 'ArchiveController@web');
	Route::get('/pause/{id}', 'ArchiveController@pause');
	Route::get('/resume/{id}', 'ArchiveController@resume');
	
});
// Website
Route::group(['prefix' => 'website', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@index']);
	Route::get('/create', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@create']);
	Route::post('/store', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@store']);
	Route::get('/show/{id}', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@show']);
	Route::get('/edit/{id}', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@destroy']);
	Route::get('/prtsc', ['middleware' => ['permission:website-manager'], 'uses' => 'WebsiteController@prtsc']);
});

// Harvet
Route::group(['prefix' => 'harvest', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'HarvestController@index']);
	Route::get('/create', ['middleware' => ['permission:harvest-manager'], 'uses' => 'HarvestController@create']);
	Route::post('/store', ['middleware' => ['permission:harvest-manager'], 'uses' => 'HarvestController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:harvest-manager'], 'uses' => 'HarvestController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:harvest-manager'], 'uses' => 'HarvestController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:harvest-manager'], 'uses' => 'HarvestController@destroy']);
	
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
// User
Route::group(['prefix' => 'user', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@index']);
	Route::get('/create', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@create']);
	Route::post('/store', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:user-manager'], 'uses' => 'UserController@destroy']);
});
// Domain
Route::group(['prefix' => 'domain', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'DomainController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'DomainController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'DomainController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'DomainController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'DomainController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'DomainController@destroy']);
});
// Format
Route::group(['prefix' => 'format', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'FormatController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FormatController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FormatController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FormatController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FormatController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FormatController@destroy']);
});
// Frequency
Route::group(['prefix' => 'frequency', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'FrequencyController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FrequencyController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FrequencyController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FrequencyController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FrequencyController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'FrequencyController@destroy']);
});
// Gender
Route::group(['prefix' => 'gender', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'GenderController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'GenderController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'GenderController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'GenderController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'GenderController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'GenderController@destroy']);
});
// Hop
Route::group(['prefix' => 'hop', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'HopController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'HopController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'HopController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'HopController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'HopController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'HopController@destroy']);
});
// Language
Route::group(['prefix' => 'language', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'LanguageController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LanguageController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LanguageController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LanguageController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LanguageController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LanguageController@destroy']);
});
// Location
Route::group(['prefix' => 'location', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'LocationController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LocationController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LocationController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LocationController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LocationController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LocationController@destroy']);
});
// Logo
Route::group(['prefix' => 'logo', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'LogoController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LogoController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LogoController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LogoController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LogoController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'LogoController@destroy']);
});
// Media
Route::group(['prefix' => 'media', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'MediaController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'MediaController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'MediaController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'MediaController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'MediaController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'MediaController@destroy']);
});
// Proccess
Route::group(['prefix' => 'proccess', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'ProccessController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ProccessController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ProccessController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ProccessController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ProccessController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ProccessController@destroy']);
});
// Record
Route::group(['prefix' => 'record', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'RecordController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'RecordController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'RecordController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'RecordController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'RecordController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'RecordController@destroy']);
});
// Search
Route::group(['prefix' => 'search', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'SearchController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SearchController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SearchController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SearchController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SearchController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SearchController@destroy']);
});
// Security
Route::group(['prefix' => 'security', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'SecurityController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SecurityController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SecurityController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SecurityController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SecurityController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SecurityController@destroy']);
});
// Source
Route::group(['prefix' => 'source', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'SourceController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SourceController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SourceController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SourceController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SourceController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SourceController@destroy']);
});
// Status
Route::group(['prefix' => 'status', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'StatusController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'StatusController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'StatusController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'StatusController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'StatusController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'StatusController@destroy']);
});
// Category
Route::group(['prefix' => 'category', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'CategoryController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'CategoryController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'CategoryController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'CategoryController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'CategoryController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'CategoryController@destroy']);
});
// Subcategory
Route::group(['prefix' => 'subcategory', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'SubcategoryController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubcategoryController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubcategoryController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubcategoryController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubcategoryController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubcategoryController@destroy']);
});
// Subject
Route::group(['prefix' => 'subject', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'SubjectController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubjectController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubjectController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubjectController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubjectController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'SubjectController@destroy']);
});
// Thumbnail
Route::group(['prefix' => 'thumbnail', 'middleware' => ['role:admin']], function() {
	Route::get('/', ['middleware' => ['permission:user-manager'], 'uses' => 'ThumbnailController@index']);
	Route::get('/create', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ThumbnailController@create']);
	Route::post('/store', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ThumbnailController@store']);
	Route::get('/edit/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ThumbnailController@edit']);
	Route::post('/update/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ThumbnailController@update']);
	Route::get('/destroy/{id}', ['middleware' => ['permission:lookup-manager'], 'uses' => 'ThumbnailController@destroy']);
});