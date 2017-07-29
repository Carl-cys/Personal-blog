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
    return redirect('/home');
});
Route::group(['prefix' => 'home'], function () {

    Route::get('/', 'Home\IndexController@index');
    //详情页面
    Route::get('/detail/{id}', 'Home\DetailController@detail')->where('id', '[0-9]+');
    //文章
    Route::get('/article/{category?}/{id?}', 'Home\ArticleController@article')->where('category', '[a-z]+')->where('id', '[0-9]+');
    //资源
    Route::get('/resource', 'Home\ResourceController@resource');
    //时光
    Route::get('/timeline', 'Home\TimeLineController@timeline');
    //关于我
    Route::get('/about', 'Home\AboutController@about');

//    Route::get('/article/{id}', 'Home\CategoryController@category');

});


Route::group(['prefix' => 'admin'], function () {
    //显示登录界面
    Route::get('/login', 'Admin\LoginController@login');
    //登录验证
    Route::post('/signIn', 'Admin\LoginController@signIn');

    Route::group(['middleware'=>'admin'], function() {

        Route::get('/signOut', 'Admin\LoginController@signOut');
        //登录后的首页
        Route::get('/', 'Admin\IndexController@index');
        //文章
        Route::resource('/article', 'Admin\ArticleController');
        //更新模块
        Route::any('/updateStaic', 'Admin\UpdateStaicController@updateStatic');
		//关于我
        Route::resource('/about', 'Admin\AboutController');
        //分类
        Route::resource('/category', 'Admin\CategoryController');
        //导航
        Route::resource('/navigation', 'Admin\NavigationController');
        //资源
        Route::resource('/resource', 'Admin\ResourceController');
        //时光
        Route::resource('/timeline', 'Admin\TimeLineController');
        //回收文章
        Route::resource('/recoveryArticle', 'Admin\RecycleArticleController');
        //资源回收
        Route::resource('/recycling', 'Admin\RecyclingController');
        //系统日志
        Route::resource('/adminlogo', 'Admin\AdminLogoController');
        //系统日志
        Route::resource('/links', 'Admin\LinksController');
        //前台格言与图片
        Route::resource('/figure', 'Admin\FigureController');
        //博主信息
        Route::resource('/personalInfo', 'Admin\PersonalInfoController');
        //公告
        Route::resource('/notice', 'Admin\NoticeController');
        //还原
        Route::any('/recovery', 'Admin\CommonController@recovery');
        //全部用户
        Route::resource('/user', 'Admin\UserController');

        //上传插件
        Route::any('/uploadCover/{filename?}', 'Admin\CommonController@uploadCover');

        Route::any ('/getAjaxMod', 'Admin\CommonController@getAjaxMod');

        Route::any ('/settings', 'Admin\SettingsController@index');
        Route::post ('/email', 'Admin\SettingsController@email');
        Route::post ('/webswitch', 'Admin\SettingsController@webSwitch');
        Route::post ('/custom', 'Admin\SettingsController@custom');
        Route::post ('/uploadsLogo', 'Admin\SettingsController@logo');


    });

});




