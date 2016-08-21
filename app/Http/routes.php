<?php


Route::get('/', 'BooksController@index');

Route::get('/home', function () {
    return view('home');
});

Route::resource('books', 'BooksController');
Route::resource('loans', 'LoansController');

Route::resource('reports/summary', 'ReportsController@summary');

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
