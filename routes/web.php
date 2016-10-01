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
Route::get('/active',function(){
    $user = \App\User::find($_GET['id']);
    if($user->token==$_GET['token']){
        $user->status = 1;
        $user->save();
        $user->roles()->attach(3);
        return redirect('/article');
    }
    else echo '激活失败';
});

Route::resource('/article','ArticleController');

Route::post('/comment','CommentController@post');
Route::delete('/comment/{id}','CommentController@destroy');

Route::get('/category/{name}','CategoryController@detail');
Route::get('/category','CategoryController@index');

Route::get('/user/{id}','UserController@user');
Route::post('/user/{id}/avatar','UserController@avatar');

Route::get('/settings','UserController@settings');
Route::get('/messages','UserController@messages');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|owner']], function() {
    //Route::get('/', 'AdminController@index');
    //Route::get('/article', 'AdminController@manageArticle');
});

Route::group(['prefix' => 'owner', 'middleware' => ['role:owner']], function() {
    Route::get('/', 'OwnerController@index');
    Route::get('/user','OwnerController@manageUser');
    //Route::get('/article','OwnerController@manageArticle');
    //Route::get('/log');
});