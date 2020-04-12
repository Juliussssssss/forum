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

Route::get('/', function () {
    return view('layouts.index');
});



Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes(['verify' => true]);

//adminka
Route::group(['namespace' => 'Forum\Admin', 'prefix' => 'admin/forum'], function() {
    Route::resource('', 'BaseController')
        ->names('forum.admin')
        ->middleware('ifAdmin');
    //category
    $methods = ['index', 'edit', 'store', 'update', 'create', 'destroy'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('forum.admin.categories')
        ->middleware('ifAdmin');
    //posts
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('forum.admin.posts')
        ->middleware('ifAdmin');
    //users
    Route::resource('users', 'UserController')
        ->names('forum.admin.users')
        ->middleware('ifAdmin');
});
//for user
Route::group(['namespace' => 'Forum', 'prefix' => 'forum'], function() {
    //сategory show
    Route::prefix( 'categories')
        ->group(function() {
            Route::get('', 'CategoryController@index')->name('forum.categories');
            Route::get('/{id}', 'CategoryController@showSubsidiaryCategories')->name('forum.categories.id');
        });
    //for comment
    Route::resource('comment', 'CommentController')
        ->names('forum.comment')
        ->middleware('verified', 'auth')
        ->only('update', 'store', 'destroy');
    //for post
    Route::resource('post', 'PostController')
        ->names('forum.post')
        ->except(['create'])
        ->middleware('verified', 'auth');
    Route::get('post/create/{id}', 'PostController@create')->name('forum.post.create');
});
Route::resource('/user','User\UserController')->names('user');
Route::get('/search', 'Forum\SearchController')->name('search');

