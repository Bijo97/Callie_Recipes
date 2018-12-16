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

Route::get('/','IndexController@index');
Route::get('blog-post','BlogController@index');
Route::get('blog-post/{id}','BlogController@getPost');
Route::get('author','IndexController@show_author');
Route::get('about','IndexController@show_about');
Route::get('contact','IndexController@show_contact');
Route::get('blank','IndexController@show_blank');
Route::get('category','CategoryController@index');
Route::get('add-post','BlogController@show_add_post');
Route::get('edit-post/{id}','BlogController@show_edit_post');
Route::get('login-page', 'UsersController@index');
Route::get('login-process', 'UsersController@login');
Route::post('insert-post', 'BlogController@store');
Route::post('update-post/{id}', 'BlogController@update');
Route::delete('delete-post/{id}', 'BlogController@destroy');
Route::get('edit-author/{id}', 'AdminController@edit_author');
Route::put('update-author/{id}', 'AdminController@update_author');
Route::get('admin', 'IndexController@show_admin');
Route::delete('delete-author/{id}', 'AdminController@delete_author');
Route::get('export-csv', 'AdminController@exportCSV');

Route::get('foo', function () {
    return 'Hello World';
});


// Route::auth();

// Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
