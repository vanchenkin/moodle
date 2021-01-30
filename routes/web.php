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

	Route::group(['middleware' => 'admin'], function(){
		Route::get('tasks', 'TaskController@index')->name('tasks');
		Route::get('task/add/{id}', 'TaskController@create')->name('task_add');
		Route::get('task/delete/{id}', 'TaskController@delete')->name('task_delete');
		Route::get('module/create', 'ModuleController@index')->name('create_module');
		Route::get('module/add', 'ModuleController@create')->name('module_add');
		Route::get('module/delete/{id}', 'ModuleController@delete')->name('module_delete');

		Route::get('groups', 'GroupController@index')->name('groups');
		Route::get('edit_groups', 'GroupController@manage')->name('edit_groups');
	});
});



//login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
