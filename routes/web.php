<?php

Route::middleware(['auth'])->group(function () {
    Route::get('/posts' , 'PostsController@index');
    Route::post('/posts', 'PostsController@store');
    Route::delete('/posts/{post}',  'PostsController@destroy');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
