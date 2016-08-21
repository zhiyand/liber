<?php


Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('/home', function () {
    return view('home');
});

Route::resource('books', 'BooksController');

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
