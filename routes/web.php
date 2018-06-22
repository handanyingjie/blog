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
Route::get('/',function (){
    return view('home.index');
});
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin_index'); //后台首页
    Route::get('/admin/info/index','AdminController@admininfo');//管理员资料
    Route::get('/admin/usermember/index','AdminController@usermembershow');//用户管理界面

    Route::get('admin/post/index','PostController@index')
        ->name('post_index');//已发文章界面
    Route::get('admin/post/show','PostController@create')
        ->name('post_create');//创建文章
    Route::post('admin/post/store','PostController@store')
        ->name('post_store')->middleware('can:create-post');//保存文章
    Route::get('admin/post/edit/{post}','PostController@edit')
        ->name('post_edit');//保存文章
    Route::put('admin/post/update/{post}','PostController@update')
        ->name('post_update')->middleware('can:update-post,post');//更新文章
    Route::delete('admin/post/destroy/{post}','PostController@destroy')
        ->name('post_destroy')->middleware('can:delete-post,post');//更新文章
});
//
//Route::group(['namespace' => 'Home'],function(){
//    Route::get('/','HomeController@index')->name('home_index');
//    Route::get('/article','ArticleController@index')->name('home_article');
//    Route::get('/show/{post}','ArticleController@show')->name('home_show');
//});


Auth::routes();

//Route::get('/home', 'HomeController@index');
