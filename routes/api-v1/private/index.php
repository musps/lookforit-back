<?php

/*
|--------------------------------------------------------------------------
| /public/user/*
|--------------------------------------------------------------------------
|
*/
Route::prefix('user')->group(function () 
{
    Route::get('me', 'UserController@me');
});

/*
|--------------------------------------------------------------------------
| /public/user_address/*
|--------------------------------------------------------------------------
|
*/
Route::prefix('user_address')->group(function () 
{
    Route::get('me', 'UserAddressController@me');
    Route::post('create', 'UserAddressController@create');
    Route::get('by_id/{id}', 'UserAddressController@byId')->where('id', '[0-9]+');
    Route::post('update/{id}', 'UserAddressController@update')->where('id', '[0-9]+');
    Route::delete('delete/{id}', 'UserAddressController@delete')->where('id', '[0-9]+');
});
