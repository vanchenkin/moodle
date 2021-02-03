<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainController@index')->name('index');

Route::group(['middleware' => 'auth'], function(){
	Route::get('tests', 'TestController@index')->name('tests');
	Route::get('test/{test}', 'TestController@test')->name('test');
	Route::get('test/start/{test}', 'TestController@start')->name('test_start');
	Route::get('test/end/{attempt}', 'TestController@end')->name('test_end');

	Route::group(['middleware' => 'admin'], function(){
		//tasks
		Route::get('tasks', 'TaskController@index')->name('tasks');
		Route::get('task/create/{module}', 'TaskController@create')->name('task_create');
		Route::post('task/add/{module}', 'TaskController@add')->name('task_add');
		Route::get('task/delete/{id}', 'TaskController@delete')->name('task_delete');
		Route::get('module/create', 'ModuleController@index')->name('create_module');
		Route::post('module/add', 'ModuleController@create')->name('module_add');
		Route::get('module/delete/{id}', 'ModuleController@delete')->name('module_delete');

		//groups
		Route::get('groups', 'GroupController@index')->name('groups');
		Route::get('group/create', 'GroupController@create')->name('group_create');

		//tests
		Route::get('test/create/{group}', 'TestController@create')->name('test_create');
		Route::post('test/add/{group}', 'TestController@add')->name('test_add');
	});
});



//login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
