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
    return view('index');
})->name('index');

Route::get('/create', function () {
    return view('index');
})->name('create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/createapplication', 'ApplicationController@create')->name('createApp');


Route::get('/applications-list', 'ApplicationController@list')->name('applications-list')->middleware('auth');