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

Route::get('test' ,function (){
    return App\Order::with('products')->get();
});

Auth::routes();
Route::get('/' , 'Front\MainController@index');
Route::get('search', 'Front\MainController@search');
//user middleware
Route::group(['middleware' => 'auth'],function (){

    Route::group(['namespace' => 'Front'], function () {

        Route::get('products', 'MainController@products');
        Route::get('products/{category_id}', 'MainController@sortProduct');
        Route::get('details/{id}' , 'MainController@details');
        Route::get('thankyou' , 'MainController@thankYou');

        //product with ajax by category_id
        Route::get('productCat', 'MainController@productCat');
    });

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'HomeController@index');
    Route::get('dashboard', 'HomeController@index');
    Route::put('save/address' , 'MyAccountController@saveAddress')->name('save-address');
    Route::post('update/password' , 'MyAccountController@updatePassword')->name('update-password');

    //my account routes
    Route::get('myaccount', 'MyAccountController@myAccount');
    Route::get('myaccount/{link}', 'MyAccountController@myAccountLink');
    Route::get('update/inbox', 'InboxController@updateInbox');
    Route::get('/inbox', 'InboxController@index');
    //track order
    Route::get('track-order/{id}' , 'MyAccountController@trackOrder');
    Route::get('/order-details/{id}', 'MyAccountController@OrderDetails');

    //cart routes
    Route::get('cart' , 'Cartcontroller@index');
    Route::get('cart/add/{id}' , 'CartController@addItem');
    Route::get('cart/remove/{id}' , 'CartController@removeItem');
    Route::get('cart/update' , 'CartController@update');

    // cart checkout
    Route::get('checkout' , 'CheckoutController@index')->name('checkout');
    Route::post('place-order' , 'CheckoutController@placeOrder');
    // check coupon
    Route::get('check-coupon' , 'CheckoutController@checkCoupon');


});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin' , 'namespace' => 'Admin'], function () {

    Route::get('home', 'AdminController@index');
    Route::get('profile', 'AdminController@profile');

    // products route
    Route::resource('products', 'ProductController');
    // update image
    Route::get('change-image/{id}', 'ProductController@changeImage')->name('image');
    Route::post('upload-image', 'ProductController@uploadImage')->name('upload-image');

    //category routes
    Route::resource('categories', 'CategoryController');

    // order routes for admin
    Route::get('orders' , 'AdminController@order');
    Route::get('order-status-update' , 'AdminController@orderStatusUpdate');

    //user routes
    Route::resource('users' , 'UserController');
    Route::get('user/change/status' , 'UserController@changeStatus')->name('change-status');

});



