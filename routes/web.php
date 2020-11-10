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

Route::get('/', 'CategoryController@index');

Route::get('/list/{id}','CategoryController@show');
Route::get('/back/{id}','CategoryController@back');
Route::get('/add/{id}/{name}','CategoryController@create');
Route::get('/addSub/{id}/{name}','CategoryController@newSubCategory');

Route::get('/done','CategoryController@showCategoryPage');
