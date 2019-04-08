<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::post('/user/login', 'UserController@login');
    Route::get('/user/info', 'UserController@info');

    Route::apiResource('channels', 'ChannelController');

    Route::get('/shops/getAllWithChannel', 'ShopController@getAllWithChannel');
    Route::apiResource('channels.shops', 'ShopController');

    Route::apiResource('devices', 'DeviceController');

});

