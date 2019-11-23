<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Web')->group(function () {

    Route::middleware(['web'])->group(function () {
        Route::middleware(['auth:web', 'admin'])->group(function () {
            Route::get('/', 'HomeController@index');
            Route::get('/home', 'HomeController@index')->name('home');
            Route::resources([
                'faqs' => 'FaqController',
            ]);
        });

        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('/google-redirect', 'Auth\SocialAuthGoogleController@redirectToProvider');
        Route::get('/google-callback', 'Auth\SocialAuthGoogleController@handleProviderCallback');
    });
});
