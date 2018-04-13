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
  Route::get('v1/get-user', 'UserController@get_user');
  Route::post('v1/delete-user', 'UserController@delete_user');
  Route::post('v1/edit-user', 'UserController@editUser');
});
// user


// events
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('v1/events/all', 'GearEventController@get_all_events');
  Route::get('v1/events/archived', 'GearEventController@get_all_archived_events');
  Route::post('v1/events/add', 'GearEventController@add_new_event');
  Route::post('v1/events/delete', 'GearEventController@delete_event');
  Route::post('v1/events/edit', 'GearEventController@edit_event');
  Route::post('v1/events/archive', 'GearEventController@archive_event');
  Route::post('v1/events/event', 'GearEventController@single_event');
});
// events


// categories
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::post('v1/categories/add', 'CategoryController@add_new_category');
  Route::post('v1/categories/edit', 'CategoryController@edit_category');
  Route::post('v1/categories/delete', 'CategoryController@delete_category');
  Route::get('v1/categories/all', 'CategoryController@get_all_categories');
  
  
  // group
  Route::post('v1/categories/group/add', 'GroupController@add_new_group');
  Route::post('v1/categories/group/delete', 'GroupController@delete_group');
  Route::post('v1/categories/group/all', 'GroupController@get_all_groups');
  
  
  
});
// categories


// equipment
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::post('v1/equipment/add', 'EquipmentController@add_new_equipment');
  Route::post('v1/equipment/delete', 'EquipmentController@delete_equipment');
  Route::post('v1/equipment/edit', 'EquipmentController@edit_equipment');
  Route::post('v1/equipment/consign', 'EquipmentController@consign_equipment');
  Route::post('v1/equipment/retire', 'EquipmentController@retire_equipment');
  Route::get('v1/equipment/all', 'EquipmentController@get_all_equipments');
  Route::get('v1/equipment/request/all', 'EquipmentController@get_all_equipments_for_request');
  
  // assign_equipment
  Route::post('v1/equipment/assign', 'EquipmentController@assign_equipment');
  Route::post('v1/equipment/unassign', 'EquipmentController@unassign_equipment');
  
  
  // requests
  Route::post('v1/request/add', 'GearRequestController@add_new_request');
  Route::post('v1/request/delete', 'GearRequestController@delete_request');
  Route::get('v1/request/all', 'GearRequestController@get_all_requests');

  
  
});
// equipment

Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});