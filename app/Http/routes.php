<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/home','IndexController@index');
Route::get('blog-post','BlogController@index');
Route::get('blog-post/{id}','BlogController@getPost');
Route::get('author','IndexController@show_author');
Route::get('about','IndexController@show_about');
Route::get('contact','IndexController@show_contact');
Route::get('blank','IndexController@show_blank');
Route::get('category','CategoryController@index');
Route::get('add-post','AdminController@show_add_post');
Route::get('edit-post/{id}','AdminController@show_edit_post');
Route::get('login-page', 'UsersController@index');
Route::get('login-process', 'UsersController@login');
Route::post('insert-post', 'AdminController@insert');
Route::put('update-post/{id}', 'AdminController@update');
Route::delete('delete-post/{id}', 'AdminController@delete');


Route::get('foo', function () {
    return 'Hello World';
});


// Route::auth();

// Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/', 'HomeController@index');
