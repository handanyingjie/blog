<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    dd($request->all());
//    return $request->user();
//});
Route::group(['namespace' => 'Home'],function (){
    Route::get('posts/{tag_id}/{page}/{limit}','HomeController@index');
    Route::get('post/{post}','ArticleController@show');
    Route::get('tags','TagController@index');
    Route::get('read','HomeController@readRank');

    Route::post('email', 'HomeController@email');
    Route::get('reply/{post_id}', 'ReplyController@index');
    Route::post('reply/store', 'ReplyController@store');
});

Route::post('/register','HomeController@register');
Route::post('/login','HomeController@login');