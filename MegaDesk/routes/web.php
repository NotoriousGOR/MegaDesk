<?php

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function() {
    // Dashboard Route
    Route::get(
    '/', 'PagesController@index')->name('home');

    Route::get(
    '/queue/', 'TicketsController@index'
    );

    Route::get(
    '/reports/', 'PagesController@Reports'
    );

    Route::any(
    '/search/', 'PagesController@Search'
    );

    Route::get(
    '/callcenter/', 'PagesController@CallCenter'
    );

    Route::get('/home', 'PagesController@index')->name('home');

    Route::get('/admin-settings/', 'PagesController@adminSettings');

    Route::get(
        '/callEntry/', 'TicketsController@create'
    );

    Route::resource('tickets', 'TicketsController');
    Route::resource('users', 'UsersController');

    // Registration Routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    Route::post('register', 'Auth\RegisterController@register');

    Route::any('/pdf/{id}', 'TicketsController@pdfGenerator');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Authentication Routes

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');

Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
