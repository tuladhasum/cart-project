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

Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/saveforlater/{product}','CartController@saveforlater')->name('cart.saveforlater');

//stoped at youtube 36:26 youtube

Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/checkout', 'CheckoutController@index')->name('cart.checkout');







Route::get('/empty', function(){
   Cart::clear();
//   dump(Cart::getContent());
   return redirect()->route('cart.index')->with('success_message', "Cart Emptied");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'test'], function(){

    Route::get('/', function(){
        Cart::add(456, 'Sample Item', 100.99, 2, array());
        Cart::add(455, 'Sample Item', 100.99, 2, array());

        return Cart::getContent();
    });
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
