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
//Route::get('/user/{name}','UserController@user');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|owner']], function() {
    //Route::get('/', 'AdminController@index');
    //Route::get('/article', 'AdminController@manageArticle');
});

Route::group(['prefix' => 'owner', 'middleware' => ['role:owner']], function() {
    //Route::get('/', 'OwnerController@index');
    //Route::get('/user','OwnerController@manageUser');
    //Route::get('/article','OwnerController@manageArticle');
    //Route::get('/log');
});