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
Route::get('/city/dashboard', 'CityController@dashboard');
Route::get('/city/logout', 'CityController@logout');