<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台登陆页
//Route::controller('admin/login','AdminLoginController');

//Route::group(['middleware'=>'AdminLogin'],function(){
	//后台首页
	//Route::get('admin','AdminController@index');
	//后台首页用户列表
	//Route::controller('admin/user','AdminUserController');
//});

//后台登陆页
Route::controller('admin/login','AdminLoginController');

Route::group(['middleware'=>'AdminLogin'],function(){
	//后台首页
	Route::get('admin','AdminController@index');
	//后台首页用户列表
	Route::controller('admin/user','AdminUserController');

});