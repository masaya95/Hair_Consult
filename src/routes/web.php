<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
  Route::get('/post/article', 'PostController@article');
  Route::post('/post/article', 'PostController@create');
  Route::get('/post/edit/{id}', 'PostController@edit');
  Route::post('/post/edit/{id}', 'PostController@update');
  Route::get('/post/{id}', 'PostController@show');
  Route::post('post/{id}', 'CommentController@create');
  Route::get('post/{id}/delete', 'PostController@destroy');
  Route::post('post/{id}/postlike', 'Post_LikeController@create');
  Route::post('post/{id}/commentlike', 'Comment_LikeController@create');
  Route::get('/user/{id}', 'UserController@index');
  Route::get('/user/like/{id}', 'UserController@like');
  Route::get('/user/comment/{id}', 'UserController@comment');
  Route::get('/user/edit/{id}', 'UserController@edit');
  Route::post('/user/edit/{id}', 'UserController@update');
  Route::get('/other/{id}', 'OtherController@index');
  Route::get('/other/like/{id}', 'OtherController@like');
  Route::get('/other/comment/{id}', 'OtherController@comment');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{category}/refine_category', 'PostController@refine_category');

Route::post('/post/search/keyword', 'PostController@search');

Route::get('/post/topics/news/{category?}', 'PostController@news');
Route::get('/post/topics/rank/{category?}', 'PostController@rank');

Route::resource('/post', 'PostController');
