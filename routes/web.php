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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    
    // activity route
    Route::resource('/', 'ActivityController');

    Route::resource('activities', 'ActivityListController@getList');
    Route::resource('activities', 'ActivityController');

    Route::resource('activitylists', 'ActivityListController');
    Route::resource('logs', 'LogController');

    //Admin
    Route::get('admin/tobeapprove', 'AdminController@toBeApprove');
    Route::resource('admin', 'AdminController');

    Route::get('search', 'SearchController@index');
});
