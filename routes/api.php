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
    Route::post('/login', 'Api\v1\LoginController@login');
    Route::post('/register', 'Api\v1\RegisterController@register');
    Route::match(['get', 'post'], '/company/create', 'Api\v1\CompanyController@create')->name('company.create');
    // Route::middleware('auth:api')
    Route::middleware('auth:api')->group(function () {
        // Company Routes
        Route::get('/company', 'Api\v1\CompanyController@index')->name('company.index');

        Route::get('/company/{id}', 'Api\v1\CompanyController@show')->name('company.show');
        Route::match(['get', 'post'], '/company/{company}/edit', 'Api\v1\CompanyController@edit')->name('company.edit');
        // Merchant Routes
        Route::get('/merchant', 'Api\v1\MerchantController@index')->name('merchant.index');
        Route::match(['get', 'post'], '/merchant/create', 'Api\v1\MerchantController@create')->name('merchant.create');
        Route::get('/merchant/{id}', 'Api\v1\MerchantController@show')->name('merchant.show');
        Route::match(['get', 'post'], '/merchant/{merchant}/edit', 'Api\v1\MerchantController@edit')->name('merchant.edit');
        Route::post('/merchant', 'Api\v1\MerchantController@index')->name('merchant.delete');
        // Order Routes
        Route::get('/order', 'Api\v1\OrderController@index')->name('order.index');
        Route::match(['get', 'post'], '/order/create', 'Api\v1\OrderController@create')->name('order.create');
        Route::match(['get', 'post'], '/order/{order}/edit', 'Api\v1\OrderController@edit')->name('order.edit');
        Route::post('/order', 'Api\v1\OrderController@index')->name('order.delete');
        // Contact Rutes
        Route::get('/contact', 'Api\v1\ContactController@index')->name('contact.index');
        Route::match(['get', 'post'], '/contact/create', 'Api\v1\ContactController@create')->name('contact.create');
        Route::match(['get', 'post'], '/contact/{contact}/edit', 'Api\v1\ContactController@edit')->name('contact.edit');
        Route::post('/contact', 'Api\v1\ContactController@index')->name('contact.delete');

        // Product Rutes
        Route::get('/product', 'Api\v1\ProductController@index')->name('product.index');
        Route::match(['get', 'post'], '/product/create', 'Api\v1\ProductController@create')->name('product.create');
        Route::match(['get', 'post'], '/product/{contact}/edit', 'Api\v1\ProductController@edit')->name('product.edit');
        Route::post('/product', 'Api\v1\ProductController@index')->name('product.delete');

    });
});
