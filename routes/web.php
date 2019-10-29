<?php

Route::middleware(['auth'])->group(function () {
//    Posts
    Route::get('/posts' , 'PostsController@index');
    Route::post('/posts', 'PostsController@store');
    Route::delete('/posts/{post}',  'PostsController@destroy');

//  Following
    Route::post('/members/{user}' , 'FollowingsController@store');
    Route::post('followers/{user}/accept' , 'FollowingsController@update');
    Route::post('followers/{user}/decline' , 'FollowingsController@destroy');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
