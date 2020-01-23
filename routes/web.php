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

Auth::routes();

Route::get('/', function () {
    return view('login');
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
Route::get('/profile/edit', 'UserController@edit_profile');
Route::post('/profileUpdate', 'UserController@profileUpdate');
Route::post('/profileInsertEmail', 'UserController@profileInsertEmail');
Route::post('/profileChangeEmail', 'UserController@profileChangeEmail');
Route::get('/profileDeleteEmail', 'UserController@profileDeleteEmail');

// Product
Route::get('/product', 'ProductController@index');
Route::get('/product/insert', 'ProductController@insert');
Route::post('/productPost', 'ProductController@productPost');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/productUpdate', 'ProductController@productUpdate');
Route::get('/productDelete/{id}', 'ProductController@productDelete');
Route::get('/productDeactivate/{id}', 'ProductController@productDeactivate');

// Courier
Route::get('/courier', 'CourierController@index');
Route::get('/courier/insert', 'CourierController@insert');
Route::post('/courierPost', 'CourierController@courierPost');
Route::get('/courier/edit/{id}', 'CourierController@edit');
Route::post('/courierUpdate', 'CourierController@courierUpdate');
Route::get('/courierDelete/{id}', 'CourierController@courierDelete');
Route::get('/courierActivate/{id}', 'CourierController@courierActivate');

// Market Place
Route::get('/marketplace', 'MarketPlaceController@index');
Route::get('/marketplace/insert', 'MarketPlaceController@insert');
Route::post('/marketplacePost', 'MarketPlaceController@marketplacePost');
Route::get('/marketplace/edit/{id}', 'MarketPlaceController@edit');
Route::post('/marketplaceUpdate', 'MarketPlaceController@marketplaceUpdate');
Route::get('/marketplaceDelete/{id}', 'MarketPlaceController@marketplaceDelete');
Route::get('/marketplaceActivate/{id}', 'MarketPlaceController@marketplaceActivate');

// Selling
Route::get('/selling', 'SellingController@index');
Route::get('/selling_table/{id_market_place}', 'SellingController@index_table');
Route::get('selling_table/sellingDelete/{id}', 'SellingController@sellingDelete');

Route::get('/selling/insert/{come_from?}', 'SellingController@insert');
Route::post('/sellingPost/{come_from?}', 'SellingController@sellingPost'); //with detail product
// id_come_from => 1 from /selling , 2 from /selling_table => 27 2[no] => id market places
Route::get('/selling/edit/{id}/{come_from?}', 'SellingController@edit');
Route::post('/sellingUpdate', 'SellingController@sellingUpdate'); //without detail product
Route::get('/selling/detail/{id}', 'SellingController@detail');
Route::get('/selling/changeToDone/{id}&{info}', 'SellingController@sellingChangeToDone');
Route::get('/sellingDelete/{id}', 'SellingController@sellingDelete');

// Selling Detail
Route::get('/sellingdetail', 'SellingDetailController@index');
Route::post('/sellingdetailsPost', 'SellingDetailController@insertsPost');
Route::get('/sellingdetailDelete/{sellings_id}&{products_id}/{come_from?}', 'SellingDetailController@sellingDetailDelete');
Route::post('/sellingdetailProductQtyIncrease', 'SellingDetailController@increaseProductQty');
Route::post('/sellingdetailProductQtyDecrease', 'SellingDetailController@decreaseProductQty');

// Shopping
Route::group(['middleware' => 'auth'], function () {
    Route::get('shopping', 'ShoppingController@index');
    Route::get('shopping/insert', 'ShoppingController@insert');
    Route::get('shopping/edit', 'ShoppingController@edit');
    Route::get('shopping/shoppingPost', 'ShoppingController@shoppingPost');
    Route::get('shopping/shoppingUpdate', 'ShoppingController@shoppingUpdate');
    Route::get('shopping/shoppingDelete', 'ShoppingController@shoppingDelete');
});

// ONLY TESTING
//Route::get('/onlyTesting/{selings_id}&{products_id}', 'SellingController@onlyTesting');
