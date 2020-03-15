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

Route::middleware(['web'])->group(function () {
    Route::middleware(['auth:web', 'admin'])->group(function () {
        Route::get('/', 'Http\Controllers\HomeController@index');
        Route::get('/home', 'Http\Controllers\HomeController@index')->name('home');
        Route::resources([
            'faqs' => 'Modules\Faq\Controllers\FaqWebController',
        ]);
    });

    Route::namespace('Modules\Auth\Controllers\Web')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');

        Route::get('/google-redirect', 'SocialAuthGoogleController@redirectToProvider');
        Route::get('/google-callback', 'SocialAuthGoogleController@handleProviderCallback');
    });
});

Route::view('privacy-policy', 'privacy_policy/privacy_policy');
