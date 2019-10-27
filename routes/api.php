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

Route::middleware(['auth:api', 'cors'])->group(function () {
    Route::apiResources([
        'clients' => 'ClientController',
        'deals' => 'DealController',
        'facilities' => 'FacilityController',
        'expenses' => 'ExpenseController',
    ]);
    Route::put('profiles', 'ProfileController@update');
    Route::get('profiles', 'ProfileController@index');
});

Route::post('users/authenticate/password', 'Auth\LoginController@login');
Route::post('users/authenticate/google', 'Auth\GoogleLoginController@login');
Route::post('users/register/password', 'Auth\RegisterController@register');
Route::post('users/register/google', 'Auth\GoogleRegisterController@register');


Route::options('clients/{any?}', ['middleware' => 'cors', function(){return;}]);
Route::options('deals/{any?}', ['middleware' => 'cors', function(){return;}]);
Route::options('facilities/{any?}', ['middleware' => 'cors', function(){return;}]);
Route::options('expenses/{any?}', ['middleware' => 'cors', function(){return;}]);
Route::options('profiles/{any?}', ['middleware' => 'cors', function(){return;}]);
Route::options('users/{any?}', ['middleware' => 'cors', function(){return;}]);
