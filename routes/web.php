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
Route::get('/','HomeController@index');
Route::get('/test','HomeController@test');
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin_index'); //后台首页
    Route::get('/admin/info/index','AdminController@admininfo');//管理员资料
    Route::get('/admin/usermember/index','AdminController@usermembershow');//用户管理界面

    Route::get('admin/post/index','PostController@index')
        ->name('post_index');//已发文章界面
    Route::get('admin/post/show','PostController@create')
        ->name('post_create');//创建文章
    Route::post('admin/post/store','PostController@store')
        ->name('post_store');//保存文章
    Route::get('admin/post/edit/{id}','PostController@edit')
        ->name('post_edit');//保存文章
    Route::put('admin/post/update/{id}','PostController@update')
        ->name('post_update');//更新文章
    Route::delete('admin/post/destroy/{id}','PostController@destroy')
        ->name('post_destroy');//更新文章
    Route::put('admin/post/published/{id}','PostController@published')
        ->name('post_published');   //发布
    Route::put('admin/post/unpublished/{id}','PostController@unPublished')
        ->name('post_unpublished');

    Route::get('admin/tag/index','TagController@index')->name('tag_index');
    Route::get('admin/tag/create','TagController@create')->name('tag_create');
    Route::post('admin/tag/store','TagController@store')->name('tag_store');
    Route::get('admin/tag/edit/{id}','TagController@edit')->name('tag_edit');
    Route::put('admin/tag/update/{id}','TagController@update')->name('tag_update');
    Route::put('admin/tag/destroy','TagController@destroy')->name('tag_destroy');
});

Auth::routes();
