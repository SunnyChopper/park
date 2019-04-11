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

Route::get('/', 'PagesController@index');
Route::get('/how-it-works', 'PagesController@how_it_works');

// Member functions
Route::get('/login', 'PagesController@login_view');
Route::get('/register', 'PagesController@register');
Route::post('/users/login', 'UserAccountsController@login');
Route::post('/users/create', 'UserAccountsController@create');
Route::get('/members/dashboard', 'MembersController@dashboard');
Route::get('/members/logout', 'MembersController@logout');

// City functions
Route::get('/city/register', 'PagesController@city_register');
Route::post('/city/register/create', 'CityAccountsController@create');
Route::get('/city/login', 'PagesController@city_login');
Route::post('/city/login/attempt', 'CityAccountsController@login');
Route::get('/city/dashboard', 'CityController@dashboard');
Route::get('/city/zones', 'CityController@view_zones');
Route::get('/city/zones/new', 'CityController@new_zone');
Route::post('/city/zones/create', 'ZonesController@create');
Route::get('/city/parkings', 'CityController@view_parking_spots');
Route::get('/city/parkings/new', 'CityController@new_parking_spot');
Route::post('/city/parkings/create', 'ParkingSpotsController@create');
Route::get('/city/logout', 'CityController@logout');