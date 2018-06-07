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
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/dashboard', 'AdminController@index'); //后台首页
    Route::get('/admin/info/index','AdminController@admininfo');//管理员资料
    Route::get('/admin/usermember/index','AdminController@usermembershow');//用户管理界面
    Route::get('admin/article/index','AdminController@articleshow');//已发文章界面
    Route::get('admin/article/show','AdminController@uploadarticle');//创建文章
});

Route::group(['namespace' => 'Home'],function(){
    Route::get('/','HomeController@index')->name('home_index');
    Route::get('article','ArticleController@index')->name('home_article');
    Route::get('show','ArticleController@show')->name('home_detail');
});

