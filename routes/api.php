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

Route::post('/vehicles/create', 'UserVehiclesController@api_create');
Route::get('/vehicles/read/{user_vehicle_id}', 'UserVehiclesController@api_read');
Route::post('/vehicles/update', 'UserVehiclesController@api_update');
Route::post('/vehicles/delete', 'UserVehiclesController@api_delete');

Route::post('/users/create', 'UserAccountsController@api_create');
Route::get('/users/read/{user_account_id}', 'UserAccountsController@api_read');
Route::post('/users/update', 'UserAccountsController@api_update');
Route::post('/users/delete', 'UserAccountsController@api_delete');
Route::post('/users/check/username', 'UserAccountsController@api_check_username');
Route::post('/users/check/email', 'UserAccountsController@api_check_email');
Route::post('/users/login', 'UserAccountsController@api_login');
Route::post('/users/vehicles', 'UserAccountsController@api_get_vehicles');
Route::post('/users/unpaid', 'UserAccountsController@api_get_unpaid_balance');

Route::post('/parkings/create', 'ParkingSessionsController@api_create');
Route::get('/parkings/read/{parking_session_id}', 'ParkingSessionsController@api_read');
Route::post('/parkings/update', 'ParkingSessionsController@api_update');
Route::post('/parkings/delete', 'ParkingSessionsController@api_delete');

Route::post('/revenues/create', 'CityRevenuesController@api_create');
Route::get('/revenues/read/{revenue_id}', 'CityRevenuesController@api_read');
Route::post('/revenues/update', 'CityRevenuesController@api_update');
Route::post('/revenues/delete', 'CityRevenuesController@api_delete');

Route::post('/admin/create', 'CityAccountsController@api_create');
Route::get('/admin/read/{city_account_id}', 'CityAccountsController@api_read');
Route::post('/admin/update', 'CityAccountsController@api_update');
Route::post('/admin/delete', 'CityAccountsController@api_delete');

Route::post('/password-resets/create');
Route::get('/password-resets/read');
Route::post('/password-resets/update');
Route::post('/password-resets/delete');

Route::post('/subuser/create', 'SubuserAccountsController@api_create');
Route::get('/subuser/read/{subuser_account_id}', 'SubuserAccountsController@api_read');
Route::post('/subuser/update', 'SubuserAccountsController@api_update');
Route::post('/subuser/delete', 'SubuserAccountsController@api_delete');

Route::post('/spots/create', 'ParkingSpotsController@api_create');
Route::get('/spots/read/{parking_spot_id}', 'ParkingSpotsController@api_read');
Route::post('/spots/update', 'ParkingSpotsController@api_update');
Route::post('/spots/delete', 'ParkingSpotsController@api_delete');

Route::get('/zones/near', 'ZonesController@api_get_near');