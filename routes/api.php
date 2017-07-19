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
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/foos', 'FooController@cget');
Route::get('/foos/{id}','FooController@get');
Route::delete('/foos/{id}', 'FooController@delete');
Route::post('/foos', 'FooController@post');
Route::put('/foos/{id}','FooController@put');


Route::group(['prefix' => 'v1'], function(){
  Route::group(['middleware' => 'jwt.auth'], function (){
    //except create & edit because they use form, meaning it is for user
    Route::resource('/bar', 'BarController', ['except' => ['create', 'edit']]);
    Route::resource('/mediafile', 'MediaFileController', ['except' => ['create', 'edit']]);
  });
  Route::post('/login_check', 'AuthenticateController@authenticate');
});
