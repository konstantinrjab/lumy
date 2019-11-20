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
            'clients'    => 'ClientController',
            'deals'      => 'DealController',
            'facilities' => 'FacilityController',
            'expenses'   => 'ExpenseController',
        ]);
        Route::get('profiles', 'ProfileController@index');
        Route::put('profiles', 'ProfileController@update');

        Route::get('users', 'UserController@index');
        Route::put('users', 'UserController@update');

        Route::get('faqs', 'FaqController@index');
    });

    Route::middleware(['api'])->group(function () {
        Route::post('users/authenticate/password', 'Auth\LoginController@login');
        Route::post('users/register/password', 'Auth\RegisterController@register');
        Route::post('users/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
        Route::post('users/password/reset/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

        Route::options('clients/{any?}', 'OptionsController');
        Route::options('deals/{any?}', 'OptionsController');
        Route::options('facilities/{any?}', 'OptionsController');
        Route::options('expenses/{any?}', 'OptionsController');
        Route::options('profiles/{any?}', 'OptionsController');
        Route::options('faqs/{any?}', 'OptionsController');
        Route::options('users/{any?}', 'OptionsController');
        Route::options('users/password/reset/{any?}', 'OptionsController');
        Route::options('users/password/reset/email/{any?}', 'OptionsController');

        Route::options('users/authenticate/{any?}', 'OptionsController');
        Route::options('users/register/{any?}', 'OptionsController');
    });
});
