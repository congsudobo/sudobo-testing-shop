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

Route::get('/', "ProductsController@index");
Route::get('/product/add', "ProductsController@create");
Route::post('/product/add', "ProductsController@store");
Route::get('/product/update', "ProductsController@edit");
Route::post('/product/update', "ProductsController@update");
Route::get('/product/delete', "ProductsController@destroy");
