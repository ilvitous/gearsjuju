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

Route::post('auth/register', 'AuthController@register');


Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');
  
});

// user
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('v1/users', 'UserController@users_all');
  Route::get('v1/user-categories', 'UserController@userCategoriesAll');
  Route::post('v1/register-role', 'UserController@registerRole');
  Route::post('v1/delete-role', 'UserController@deleteRole');
  Route::get('v1/roles-all', 'UserController@userCategoriesAll');
  Route::post('v1/set-role', 'UserController@setRole');
  Route::post('v1/get-user', 'UserController@get_user');
  Route::post('v1/delete-user', 'UserController@delete_user');
  Route::post('v1/edit-user', 'UserController@editUser');
});
// user


// events
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('v1/events/all', 'GearEventController@get_all_events');
  Route::post('v1/events/add', 'GearEventController@add_new_event');
  Route::post('v1/events/delete', 'GearEventController@delete_event');
  Route::post('v1/events/edit', 'GearEventController@edit_event');
  Route::post('v1/events/event', 'GearEventController@single_event');
  
});
// events


Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});