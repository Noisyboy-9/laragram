<?php

Route::get('/posts' , 'PostsController@index');
Route::post('/posts', 'PostsController@store');
