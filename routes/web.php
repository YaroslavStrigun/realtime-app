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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-json', 'HomeController@getJson')->name('get-json');

Route::get('/data-chart', 'HomeController@dataChart')->name('data-chart');

Route::get('/random-chart', 'HomeController@randomChart')->name('random-chart');

Route::get('/new-event', 'HomeController@newEvent')->name('new-event');

Route::get('/send-message', 'HomeController@sendMessage');

Route::get('/send-private-message', 'HomeController@sendPrivateMessage');





