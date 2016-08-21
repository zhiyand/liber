<?php


Route::get('/', 'BooksController@index');
Route::get('/home', 'BooksController@index');

Route::get('/books/search', 'SearchController@index');

Route::resource('books', 'BooksController');
Route::resource('loans', 'LoansController');
Route::resource('users', 'UsersController');

Route::resource('reports/summary', 'ReportsController@summary');

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
