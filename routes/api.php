<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

https://developer.okta.com/blog/2018/12/06/crud-app-laravel-react

*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
