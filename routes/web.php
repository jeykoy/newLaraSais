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
    return view('larasaisindex');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/orderlists','OrderlistController');

Route::get('/orderlistCompute', function () {
    return view('orderlists.index');
});