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

Route::get('/dashboard', 'PagesController@getDashboard')->name('pages.dashboard');
// Profiles
Route::resource('profile', 'ProfileController');

// Bank Accounts
Route::resource('account', 'AccountsController', ['only'=>['index','store']]);
//,['only' => ['create', 'update', 'show']]

// Bill
Route::post('/bill/storepaymentoption', 'BillController@storeStep2')->name('bill.store_paymentoption');
Route::post('/bill/submitbill', 'BillController@storeStep3')->name('bill.submit_bill');
Route::resource('bill', 'BillController',['except' => ['index']]);

// Admin Controller

Route::get('/secureadmin', 'AdminController@index')->name('admin.index');

Route::get('/secureadmin/profile/{profile}', 'AdminController@getProfile')->name('admin.profile');
Route::post('/secureadmin/itemdetail', 'AdminController@postItemDetail')->name('admin.itemdetail');

Route::post('/secureadmin/ach', 'AdminController@postAch')->name('stripe.ach');