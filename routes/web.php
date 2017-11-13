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
// Route::get('/', 'IndexController@index');
Route::get('/', 'Admin\CoursesController@index')->name('list_course');
Route::get('error', 'IndexController@handle_err')->name('error');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('admin/courses', 'Admin\CoursesController@index')->name('list_course');
Route::get('admin/course/add', 'Admin\CoursesController@course_add');
Route::get('admin/course/edit/{id}', 'Admin\CoursesController@course_add')->name('edit_course');
Route::post('admin/course/save', 'Admin\CoursesController@course_save');
Route::get('admin/course/delete/{id}', 'Admin\CoursesController@course_delete');

Route::get('admin/course_modules/{cid}', 'Admin\CoursesController@course_modules_list')->name('list_course_modules');
Route::get('admin/course_module/add/{cid}', 'Admin\CoursesController@course_module_add')->name('add_course_module');
Route::get('admin/course_module/edit/{cid}/{id}', 'Admin\CoursesController@course_module_add')->name('edit_course_module');
Route::post('admin/course_module/save', 'Admin\CoursesController@course_module_save');
Route::get('admin/course_module/delete/{id}', 'Admin\CoursesController@course_module_delete');