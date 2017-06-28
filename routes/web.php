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

Route::get('/', function () {
    return view('pages.welcome');
})->name('pages.welcome');;

Auth::routes();


// Facebook Login Routes
Route::get('/auth/facebook', 'Auth\LoginController@redirectToProvider')->name('login.facebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/dashboard', 'PageController@getDashboard')->name('pages.dashboard');
// Profiles
Route::resource('profile', 'ProfileController');

// Bank Accounts
Route::resource('account', 'AccountsController');
//,['only' => ['create', 'update', 'show']]