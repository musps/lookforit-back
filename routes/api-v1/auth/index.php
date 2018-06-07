<?php

Route::post('/log_in', 'AuthController@logIn');
Route::post('/log_out', 'AuthController@logOut')->middleware('checkBearerToken');
Route::post('/register', 'AuthController@register');
