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


/**
 * All auth routes, including Admin are defined in this route
 * for better understanding check \techie\vendor\laravel\ui\src\AuthRouteMethods.php
 */
Auth::routes();

/**
 * Front routes
 */
Route::get('/', 'Front\FrontController@index');
Route::get('/view/{slug}', 'Front\FrontController@view')->name('view.product');
Route::get('/shopping-cart', 'Front\CartController@cart')->name('shopping.cart');
Route::get('/add-to-cart/{id}', 'Front\CartController@addToCart')->name('product.addToCart');
Route::post('/update-cart-item', 'Front\CartController@updateQty')->name('qty.update');
Route::get('/remove-cart-item/{id}', 'Front\CartController@destroy')->name('item.remove');
Route::delete('/destroy-shopping-cart', 'Front\CartController@cart_destroy')->name('cart.destroy');
/**
 * every customer should be registered before checkout
 * 
 */
Route::middleware('auth')->group(function(){
    Route::get('/checkout', 'Front\CheckoutController@index')->name('checkout');
    Route::post('/checkout', 'Front\CheckoutController@checkout');
    //route for stripe payment method
    Route::post('/stripe', 'Front\CheckoutController@stripe')->name('stripe');
});

/**
 * Admin panel routes
 * the middleware route restrict url access
 */
Route::group(['prefix' => 'admin'], function () {
    Route::middleware('auth:admin')->group(function(){
        //Admin home route
        Route::get('/home', 'Admin\AdminController@index')->name('admin.home');

        //category page route
        Route::resource('categories', 'Admin\CategoryController');
        Route::put('categories/update','Admin\CategoryController@update')->name('category.update');

        //brand route
        Route::resource('brands', 'Admin\BrandController');
        Route::put('brands/update','Admin\BrandController@update')->name('brand.update');

        //product route
        Route::resource('products', 'Admin\ProductController');
        Route::get('products/delete/{id}','Admin\ProductController@destroy')->name("product.delete");
        Route::put('product/update', 'Admin\ProductController@update')->name('product.update');
        Route::post('show/product/{id}', 'Admin\ShowProductController@index');

        //order routes
        Route::resource('orders', 'Admin\OrderController');
        Route::get('confirmed-orders', 'Admin\OrderController@confirmed')->name('orders.confirmed');
        Route::get('cancelled-orders', 'Admin\OrderController@cancelled')->name('orders.cancelled');
        Route::post('order/update', 'Admin\OrderController@update')->name('order.update');

        //coupon routes
        Route::resource('coupons', 'Admin\CouponController');
        Route::put('coupons/update','Admin\BrandController@update')->name('coupon.update');
    });
});

Route::get('/home', 'HomeController@index')->name('home');