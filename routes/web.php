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


Auth::routes();


Route::post('/follow/{user}', 'FollowsController@store');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/','PostsController@index');
Route::get('/p/create','PostsController@create');
Route::post('/p','PostsController@store');
Route::post('/p/{post}/like','PostsController@like');
Route::post('/p/{post}/unlike','PostsController@unlike');
Route::get('/p/{post}/count','PostsController@likeCount');
Route::get('/p/{post}/reacted','PostsController@hasReacted');
Route::get('/p/{post}','PostsController@show');
