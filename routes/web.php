<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::resource('/article','ArticleController');
Route::get('/search','ArticleController@search');

Route::post('/comment','CommentController@post');
Route::delete('/comment/{id}','CommentController@destroy');

Route::get('/category/{name}','CategoryController@detail');
Route::get('/category','CategoryController@index');

Route::get('/user/{id}','UserController@user');
Route::post('/user/{id}/avatar','UserController@avatar');
Route::post('/user/{id}/update','UserController@update');
Route::get('/settings','UserController@settings');
Route::get('/check',function (){return view('user.check');});
Route::get('/active','UserController@active');

Route::get('/messages','MessageController@index');
Route::get('/message','MessageController@create');
Route::post('/sendMessage','MessageController@send');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|owner']], function() {
    //Route::get('/', 'AdminController@index');
    //Route::get('/article', 'AdminController@manageArticle');
});

Route::group(['prefix' => 'owner', 'middleware' => ['role:owner']], function() {
    Route::get('/', 'OwnerController@index');
    Route::get('/user','OwnerController@manageUser');
    Route::get('/user/toggle','OwnerController@toggle');
    Route::get('/user/adminToggle','OwnerController@adminToggle');
    Route::get('/user/search','OwnerController@searchUser');
    Route::get('/user/unratified','OwnerController@unratified');
    Route::get('/user/admin','OwnerController@admin');
    Route::get('/message','OwnerController@message');
    Route::post('/sendMessage','OwnerController@sendMessage');
    //Route::get('/article','OwnerController@manageArticle');
    //Route::get('/log');
});