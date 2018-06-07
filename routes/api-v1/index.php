<?php

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
|
*/
$aPublicConfig = [
  'prefix' => 'public'
];
Route::group($aPublicConfig, function () {
    require __DIR__.'/public/index.php';
});

/*
|--------------------------------------------------------------------------
| Private routes
|--------------------------------------------------------------------------
|
*/
$aPrivateConfig = [
  'prefix' => 'private',
  'middleware' => 'checkBearerToken'
];
Route::group($aPrivateConfig, function () {
    require __DIR__.'/private/index.php';
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
|
*/
$aPrivateConfig = [
  'prefix' => 'auth',
];
Route::group($aPrivateConfig, function () {
    require __DIR__.'/auth/index.php';
});
