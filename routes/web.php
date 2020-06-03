<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    // Company Routes
//    Route::get('/company', 'CompanyController@index')->name('company.index');
//    Route::get('/company/{id}', 'CompanyController@show')->name('company.show');
//    Route::match(['get', 'post'], '/company/{company}/edit', 'CompanyController@edit')->name('company.edit');

    // Merchant Routes
    Route::get('/merchant', 'MerchantController@index')->name('merchant.index');
    Route::match(['get', 'post'], '/merchant/create', 'MerchantController@create')->name('merchant.create');
    Route::get('/merchant/{id}', 'MerchantController@show')->name('merchant.show');
    Route::match(['get', 'post'], '/merchant/{merchant}/edit', 'MerchantController@edit')->name('merchant.edit');
    Route::post('/merchant', 'MerchantController@index')->name('merchant.delete');

    // Order Routes
   Route::get('/order', 'OrderController@index')->name('order.index');
   Route::match(['get', 'post'], '/order/create', 'OrderController@create')->name('order.create');
   Route::match(['get', 'post'], '/order/{order}/edit', 'OrderController@edit')->name('order.edit');
   Route::post('/order', 'OrderController@index')->name('order.delete');

    // Contact Rutes
   Route::get('/contact', 'ContactController@index')->name('contact.index');
   Route::match(['get', 'post'], '/contact/create', 'ContactController@create')->name('contact.create');
   Route::match(['get', 'post'], '/contact/{contact}/edit', 'ContactController@edit')->name('contact.edit');
   Route::post('/contact', 'ContactController@index')->name('contact.delete');

    // Product Rutes
   Route::get('/product', 'ProductController@index')->name('product.index');
   Route::match(['get', 'post'], '/product/create', 'ProductController@create')->name('product.create');
   Route::match(['get', 'post'], '/product/{contact}/edit', 'ProductController@edit')->name('product.edit');
   Route::post('/product', 'ProductController@index')->name('product.delete');

    // Package Rutes
    Route::get('/package', 'PackageController@index')->name('package.index');
    //Route::match(['get', 'post'], '/package/create', 'PackageController@create')->name('package.create');
    Route::match(['get', 'post'], '/package/{contact}/edit', 'PackageController@edit')->name('package.edit');
    Route::post('/package', 'PackageController@index')->name('package.delete');
    

});
