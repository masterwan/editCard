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

Route::get('/', function () {return view('index.index');});

Auth::routes();

Route::get('/cards', 'CardController@index')->middleware('NoHttpCache')->name('cards');
Route::get('/card/{id}', 'CardController@edit')->middleware('NoHttpCache')->name('card_edit');
Route::get('/card/download-image/{id}', 'CardController@downloadImage')->name('download_img_wear');
Route::post('/card/upload-image/{id}', 'CardController@uploadImage')->name('upload_img_wear');
