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

Route::post('/vehicles/create');
Route::get('/vehicles/show');
Route::post('/vehicles/update');
Route::post('/vehicles/delete');

Route::post('/customers/create');
Route::get('/customers/show');
Route::post('/customers/update');
Route::post('/customers/delete');

Route::post('/parkings/create');
Route::get('/parkings/show');
Route::post('/parkings/update');
Route::post('/parkings/delete');

Route::post('/revenues/create');
Route::get('/revenues/show');
Route::post('/revenues/update');
Route::post('/revenues/delete');

Route::post('/admin/create');
Route::get('/admin/show');
Route::post('/admin/update');
Route::post('/admin/delete');

Route::post('/password-resets/create');
Route::get('/password-resets/show');
Route::post('/password-resets/update');
Route::post('/password-resets/delete');

Route::post('/subuser/create');
Route::get('/subuser/show');
Route::post('/subuser/update');
Route::post('/subuser/delete');

Route::post('/spots/create');
Route::get('/spots/show');
Route::post('/spots/update');
Route::post('/spots/delete');