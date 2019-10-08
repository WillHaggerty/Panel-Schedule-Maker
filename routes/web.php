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

Route::get('/home', 'OrgsController@index');

Auth::routes();

Route::resource('jobs', 'JobsController');
Route::resource('jobs/{job}/panels', 'PanelsController');
Route::get('jobs/{job}/panels/{panel}/circuits/edit', 'CircuitsController@edit')->middleware('can:update,panel');
Route::post('jobs/{job}/panels/{panel}/circuits/create', 'CircuitsController@store')->middleware('can:update,panel');
Route::patch('jobs/{job}/panels/{panel}/circuits/{circuit}', 'CircuitsController@update')->middleware('can:update,panel');
Route::delete('jobs/{job}/panels/{panel}/circuits/{circuit}', 'CircuitsController@destroy')->middleware('can:update,panel');
