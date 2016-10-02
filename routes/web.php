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
Route::get('/active','UserController@active');
Route::get('/settings','UserController@settings');
Route::get('/messages','UserController@messages');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|owner']], function() {
    //Route::get('/', 'AdminController@index');
    //Route::get('/article', 'AdminController@manageArticle');
});

Route::group(['prefix' => 'owner', 'middleware' => ['role:owner']], function() {
    Route::get('/', 'OwnerController@index');
    Route::get('/user','OwnerController@manageUser');
    Route::get('/user/toggle','OwnerController@toggle');
    Route::get('/user/adminToggle','OwnerController@adminToggle');
    //Route::get('/article','OwnerController@manageArticle');
    //Route::get('/log');
});