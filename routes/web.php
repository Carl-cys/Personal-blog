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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['prefix' => 'home'], function () {

    Route::get('/index', 'Home\IndexController@index');

    Route::get('/detail', 'Home\ArticleController@detail');

    Route::get('/resource', 'Home\ResourceController@resource');

    Route::get('/timeline', 'Home\TimeLineController@timeline');

    Route::get('/about', 'Home\AboutController@about');



});


Route::group(['prefix' => 'admin'], function () {
    //显示登录界面
    Route::get('/login', 'Admin\LoginController@login');
    //登录验证
    Route::post('/signIn', 'Admin\LoginController@signIn');

    Route::group(['middleware'=>'admin'], function() {

        //登录后的首页
        Route::get('/', 'Admin\IndexController@index');
        //文章
        Route::resource('/article', 'Admin\ArticleController');
        //分类
        Route::resource('/category', 'Admin\CategoryController');
        //导航
        Route::resource('/navigation', 'Admin\NavigationController');
        //资源
        Route::resource('/resource', 'Admin\ResourceController');
        //上传插件
        Route::any('/uploadCover/{filename?}', 'Admin\CommonController@uploadCover');

        Route::any ('/getAjaxMod', 'Admin\CommonController@getAjaxMod');


    });

});




