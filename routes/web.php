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

Route::get('denied', 'MainController@denied')->name('denied');

Route::get('/', 'MainController@index')->name('index');

Route::group(['middleware' => 'auth'], function(){
	//tests
	Route::get('tests', 'TestController@index')->name('tests');
	Route::get('test/{test}', 'TestController@test')->name('test');
	Route::get('test/start/{test}', 'TestController@start')->name('test_start');
	Route::post('test/end/{attempt}', 'TestController@end')->name('test_end');

	Route::group(['middleware' => 'admin'], function(){
		Route::get('tasks', 'TaskController@index')->name('tasks');
		Route::get('groups', 'GroupController@index')->name('groups');
		Route::get('attempt/{test}/{user}', 'TestController@attempt')->name('attempt');
		Route::get('task/{task}', 'TaskController@task')->name('task');
		Route::group(['middleware' => 'teacher'], function(){
			//tasks

			Route::get('task/create/{module}', 'TaskController@create')->name('task_create');
			Route::post('task/add/{module}', 'TaskController@add')->name('task_add');
			Route::get('task/update/{task}', 'TaskController@update')->name('task_update');
			Route::post('task/change/{task}', 'TaskController@change')->name('task_change');
			Route::get('task/delete/{id}', 'TaskController@delete')->name('task_delete');
			Route::get('module/create', 'ModuleController@index')->name('module_create');
			Route::post('module/add', 'ModuleController@create')->name('module_add');
			Route::get('module/delete/{id}', 'ModuleController@delete')->name('module_delete');

			//tests
			Route::get('test/create/{group}', 'TestController@create')->name('test_create');
			Route::post('test/add/{group}', 'TestController@add')->name('test_add');
			Route::get('test/delete/{test}', 'TestController@delete')->name('test_delete');
			Route::group(['middleware' => 'system'], function(){
				//groups
				Route::get('group/create', 'GroupController@create')->name('group_create');
				Route::post('group/add', 'GroupController@add')->name('group_add');
				Route::get('group/delete/{group}', 'GroupController@delete')->name('group_delete');
				Route::get('group/{group}/update', 'GroupController@update')->name('group_update');
				Route::post('group/{group}/change', 'GroupController@change')->name('group_change');

				//users
				Route::get('user/create', 'UserController@create')->name('user_create');
				Route::post('user/add', 'UserController@add')->name('user_add');
				Route::get('user/delete/{user}', 'UserController@delete')->name('user_delete');
				Route::get('users', 'UserController@index')->name('users');
			});
		});
	});
});



//login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
