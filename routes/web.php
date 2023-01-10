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
// Home Route
Route::get('/', 'FilmController@index')->name('films');
Route::get('/films', 'FilmController@index')->name('films');
// Authentication Routes
Auth::routes();
// Add Film form Route
Route::get('/films/create', 'FilmController@create')->name('create');
// Show Single Film through Slug
Route::get('/films/{slug}', 'FilmController@show')->name('film');
// Save Film
Route::post('/films/create', 'FilmController@store')->name('create');
// Save Comment
Route::post('/films/store', 'CommentController@store')->name('storeComment');






