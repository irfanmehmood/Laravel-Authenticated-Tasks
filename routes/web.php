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


/** Inline closure function */
Route::get('/', 'PostController@index');

/** Show all posts, posts home page*/
Route::get('/posts', 'PostController@index');

/** Stores a post */
Route::post('/posts', 'PostController@store');

/** Shows create post form */
Route::get('/posts/create', 'PostController@create');

/** Shows posts by id*/
/** using Route Model Binding - Read my_read_me_md. 7.Route Model Binding */
Route::get('/posts/{post}', 'PostController@show');

/** using Route Model Binding - Add, create comments for viewed post */
Route::post('/posts/{post}/comments', 'CommentsController@create');

Route::get('/examples/tasks/using-query-builder/{task_id}', 'TasksController@taskByByQueryBuilder');

/** using Route Model Binding - Read my_read_me_md. 7.Route Model Binding */
Route::get('/examples/tasks/using-eloquent-model/{task}', 'TasksController@taskByEloquentModel');

Route::get('/examples/tasks/show/using-query-builder', 'TasksController@showByQueryBuilder');

Route::get('/examples/tasks/show/using-eloquent-model', 'TasksController@showByEloquentModel');

Auth::routes();

/** Not using this as this was created by auth */
#Route::get('/home', 'HomeController@index')->name('home');
