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

Route::resource('notas', 'NotasController');

/*
Route::get('/notas', 'NotasController@index')->name('notas.index');
Route::get('/notas/new', 'NotasController@create')->name('notas.create');
Route::post('/notas/new', 'NotasController@store')->name('notas.store');
Route::get('/notas/{id}', 'NotasController@show')->name('notas.show');
Route::get('/notas/{id}/edit', 'NotasController@edit')->name('notas.edit');
Route::put('/notas/{id}/edit', 'NotasController@update')->name('notas.update');
Route::delete('/notas/{id}/delete', 'NotasController@destroy')->name('notas.destroy');
*/