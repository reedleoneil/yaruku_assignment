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

Route::get('/', 'BookController@index');
Route::get('/exportToExcel', 'BookController@exportToExcel');
Route::get('/exportToCSV', 'BookController@exportToCSV');
Route::get('/api/getBooks', 'API\BookController@getBooks');
Route::get('/api/getBook', 'API\BookController@getBook');
Route::post('/api/insertBook', 'API\BookController@insertBook');
Route::post('/api/updateBook', 'API\BookController@updateBook');
Route::post('/api/deleteBook', 'API\BookController@deleteBook');
