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

Route::middleware(['cors', 'auth:api'])->group(function () {
    Route::apiResources([
        'clients' => 'ClientController',
        'deals' => 'DealController',
        'facilities' => 'FacilityController',
        'expenses' => 'ExpenseController',
    ]);
    Route::put('profiles', 'ProfileController@update');
    Route::get('profiles', 'ProfileController@index');
});

Route::middleware(['cors'])->group(function () {
    Route::post('users/authenticate/password', 'Auth\LoginController@login');
    Route::post('users/authenticate/google', 'Auth\GoogleLoginController@login');
    Route::post('users/register/password', 'Auth\RegisterController@register');
    Route::post('users/register/google', 'Auth\GoogleRegisterController@register');

    Route::options('clients/{any?}', function(){return;});
    Route::options('deals/{any?}', function(){return;});
    Route::options('facilities/{any?}', function(){return;});
    Route::options('expenses/{any?}', function(){return;});
    Route::options('profiles/{any?}', function(){return;});

    Route::options('users/authenticate/{any?}', function(){return;});
    Route::options('users/register/{any?}', function(){return;});
});
