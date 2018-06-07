<?php

Route::prefix('user')->group(function () 
{
    Route::get('list', 'UserController@list');
});
