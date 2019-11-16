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

Route::namespace('Api')->group(function () {

    Route::middleware(['auth:api'])->group(function () {
        Route::apiResources([
            'clients' => 'ClientController',
            'deals' => 'DealController',
            'facilities' => 'FacilityController',
            'expenses' => 'ExpenseController',
        ]);
        Route::put('profiles', 'ProfileController@update');
        Route::get('profiles', 'ProfileController@index');
        Route::get('faqs', 'FaqController@index');
    });

    Route::middleware(['api'])->group(function () {
        Route::post('users/authenticate/password', 'Auth\LoginController@login');
        Route::post('users/register/password', 'Auth\RegisterController@register');

        Route::options('clients/{any?}', 'OptionsController');
        Route::options('deals/{any?}', 'OptionsController');
        Route::options('facilities/{any?}', 'OptionsController');
        Route::options('expenses/{any?}', 'OptionsController');
        Route::options('profiles/{any?}', 'OptionsController');

        Route::options('users/authenticate/{any?}', 'OptionsController');
        Route::options('users/register/{any?}', 'OptionsController');
    });
});
