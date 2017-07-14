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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {

    Route::resource('/index', 'Admin\IndexController');

    Route::resource('/article', 'Admin\ArticleController');

    Route::get('/login', 'Admin\LoginController@login');
	
    Route::post('/getAjaxLogin', 'Admin\LoginController@getAjaxLogin');

  
//    Route::resource('/login', 'Admin\LoginController');


});