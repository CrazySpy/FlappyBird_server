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

Route::post('Playing', 'ScoreController@log')->middleware(['auth.yiban', 'rsa']);
Route::post('UpdateScore', 'ScoreController@refresh')->middleware(['auth.yiban', 'rsa']);
Route::get('TopList', 'ScoreController@topList')->middleware('auth.yiban');

Route::get('/', 'IndexController@index')->middleware('auth.yiban')->name('index');
Route::get('YibanAuth', 'AuthController@auth')->name('auth');