<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function () {
    //User auth routes
    Route::post('/login', 'api\v1\LoginController@login');
    Route::post('/register', 'api\v1\RegisterController@register');

    // Route::middleware('auth:api')
    Route::middleware('auth:api')->group(function () {
        // Company Routes
        Route::get('/company', 'CompanyController@index')->name('company.index');
        Route::match(['get', 'post'], '/company/create', 'CompanyController@create')->name('company.create');
        Route::match(['get', 'post'], '/company/{company}/edit', 'CompanyController@edit')->name('company.edit');
        // Company Routes
        Route::get('/merchant', 'MerchantController@index')->name('merchant.index');
        Route::match(['get', 'post'], '/merchant/create', 'MerchantController@create')->name('merchant.create');
        Route::match(['get', 'post'], '/merchant/{merchant}/edit', 'MerchantController@edit')->name('merchant.edit');
        Route::post('/merchant', 'MerchantController@index')->name('merchant.delete');
        // Order Routes
        Route::get('/order', 'OrderController@index')->name('order.index');
        Route::match(['get', 'post'], '/order/create', 'OrderController@create')->name('order.create');
        Route::match(['get', 'post'], '/order/{order}/edit', 'OrderController@edit')->name('order.edit');
        Route::post('/order', 'OrderController@index')->name('order.delete');
    });
});
