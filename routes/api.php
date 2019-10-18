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

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'clients' => 'ClientController',
        'deals' => 'DealController',
        'facilities' => 'FacilityController'
    ]);
});

Route::post('users/authenticate/password', 'Auth\LoginController@login');
Route::post('users/register', 'Auth\RegisterController@register');
