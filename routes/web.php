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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();


Route::get('/threads', 'ThreadsController@index');  
Route::get('/threads/{categories}/{thread}', 'ThreadsController@show'); //show each unique thread
Route::patch('/threads/{categories}/{thread}', 'ThreadsController@update');
Route::delete('/threads/{categories}/{thread}', 'ThreadsController@delete');
Route::get('/threads/create', 'ThreadsController@create'); 
Route::post('/threads', 'ThreadsController@store'); //store threads

Route::post('/threads/{categories}/{thread}/replies', 'RepliesController@store');  //show thread replies 
Route::delete('/replies/{reply}', 'RepliesController@delete'); 
Route::get('threads/{categories}', 'ThreadsController@index');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');;  