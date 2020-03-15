<?php

use \Illuminate\Support\Facades\Route;

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


Route::middleware(['auth:api'])->group(function () {

    Route::namespace('Modules')->group(function () {
        Route::apiResources([
            'deals'   => 'Deal\Controllers\DealController',
            'clients' => 'Client\Controllers\ClientController',
            'expenses'   => 'Expense\Controllers\ExpenseController',
            'facilities' => 'Facility\Controllers\FacilityController',
        ]);

        Route::namespace('User\Controllers')->group(function () {
            Route::get('profiles', 'ProfileController@index');
            Route::put('profiles', 'ProfileController@update');

            Route::get('users', 'UserController@index');
            Route::put('users', 'UserController@update');
        });
    });

    Route::get('faqs', 'Modules\Faq\Controllers\FaqApiController@index');
});

Route::middleware(['api'])->group(function () {
    Route::namespace('Modules\Auth\Controllers\Api')->group(function () {
        Route::post('users/authenticate/password', 'LoginController@login');
        Route::post('users/register/password', 'RegisterController@register');
        Route::post('users/password/reset', 'ResetPasswordController@reset')->name('password.reset');
        Route::post('users/password/reset/email', 'ForgotPasswordController@sendResetLinkEmail');
    });

    Route::namespace('Http\Controllers')->group(function () {
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
