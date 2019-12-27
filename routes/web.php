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

// Stackdriver Logging
Route::get('/log/{message}', function ($message) {
    Log::info("Hello my log, message: $message");
    return view('welcome');
});
// Stackdriver Error Reporting
Route::get('/exception/{message}', function ($message) {
    throw new Exception("Intentional exception, message: $message");
});

// login
Route::get('/dashboard', 'UserController@index');
Route::get('/login', 'UserController@login');
Route::post('/loginPost', 'UserController@loginPost');
Route::get('/register', 'UserController@register');
Route::post('/registerPost', 'UserController@registerPost');
Route::get('/logout', 'UserController@logout');

// Profile
Route::get('/profile', 'UserController@profile');
Route::post('/profileUpdate', 'UserController@profileUpdate');

// Product
Route::get('/product', 'ProductController@index');
Route::get('/product/insert', 'ProductController@insert');
Route::post('/productPost', 'ProductController@productPost');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/productUpdate', 'ProductController@productUpdate');
Route::get('/productDelete/{id}', 'ProductController@productDelete');

// Courier
Route::get('/courier', 'CourierController@index');
Route::get('/courier/insert', 'CourierController@insert');
Route::post('/courierPost', 'CourierController@courierPost');
Route::get('/courier/edit/{id}', 'CourierController@edit');
Route::post('/courierUpdate', 'CourierController@courierUpdate');
Route::get('/courierDelete/{id}', 'CourierController@courierDelete');

// Market Place
Route::get('/marketplace', 'MarketPlaceController@index');
Route::get('/marketplace/insert', 'MarketPlaceController@insert');
Route::post('/marketplacePost', 'MarketPlaceController@marketplacePost');
Route::get('/marketplace/edit/{id}', 'MarketPlaceController@edit');
Route::post('/marketplaceUpdate', 'MarketPlaceController@marketplaceUpdate');
Route::get('/marketplaceDelete/{id}', 'MarketPlaceController@marketplaceDelete');

// Selling
Route::get('/selling', 'SellingController@index');
Route::get('/selling_table/{marketplace}', 'SellingController@index_table');
Route::get('selling_table/sellingDelete/{id}', 'SellingController@sellingDelete');

Route::get('/selling/insert', 'SellingController@insert');
Route::get('/selling/detail/{id}', 'SellingController@detail');
Route::post('/sellingPost', 'SellingController@sellingPost'); //with detail product
Route::get('/selling/changeToDone/{id}&{info}', 'SellingController@sellingChangeToDone');
Route::get('/sellingDelete/{id}', 'SellingController@sellingDelete');

// Selling Detail
Route::get('/sellingdetail', 'SellingDetailController@index');
