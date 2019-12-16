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
    return view('login');
});

Route::get('/halaman-kedua', function () {
    return view('halamandua');
});

Route::get('/dashboard', 'UserController@index');
Route::get('/login', 'UserController@login');
Route::post('/loginPost', 'UserController@loginPost');
Route::get('/register', 'UserController@register');
Route::post('/registerPost', 'UserController@registerPost');
Route::get('/logout', 'UserController@logout');


