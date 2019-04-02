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
use \App\User;
use \App\Log;


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
    Route::get('admin/filterbyname', 'AdminController@filterByName');
    Route::get('admin/userfetchdata', 'AdminController@userFetchData');
    Route::resource('admin', 'AdminController');

    Route::get('search', 'SearchController@index');

    //EXPORT DATA
    Route::get('/all-logs-csv', function(){

        $table = Log::join('users', 'logs.user_id', '=', 'users.id')
            ->select('logs.*', 'users.name')
            ->get();

        $filename = "logs.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Name', 'Title', 'Productivty Time', 'Message', 'Date'));
    
        foreach($table as $row) {

            fputcsv($handle, array($row['name'], $row['activity_name'], $row['activity_time_consume'], $row['message'], $row['created_at']));
        }
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
    
        return Response::download($filename, 'logs.csv', $headers);
    });
});
