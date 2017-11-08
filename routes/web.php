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

// INDEX CONTROLLER
Route::get('/', 'IndexController@index');
Route::get('error', 'IndexController@handle_err')->name('error');

