<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/register', 'RegisterController@showForm')->name('register.showForm');
    Route::post('/register', 'RegisterController@register')->name('register.store');

    /**
     * Login Routes
     */
    Route::get('/login', 'LoginController@showForm')->name('login.showForm');
    Route::post('/login', 'LoginController@login')->name('login.check');

});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', 'LogoutController@logout')->name('logout');
});