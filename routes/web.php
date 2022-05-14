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
//Profile
Route::post('profile/update/{id}', 'HomeController@updateProfile')->name('profile.update');
Route::group(['middleware' => 'auth'], function () {
    //Shop
    Route::get('/shop', 'ShopController@index')->name('shop.index')->middleware('shopregistrationcheck');
    Route::get('shop/registration', 'ShopController@register')->name('shop.register');
    Route::post('shop/registration/store', 'ShopController@register_store')->name('shop.store');
    Route::get('shop/registration/edit/', 'ShopController@edit')->name('shop.edit');
    Route::put('shop/registration/update/{id}', 'ShopController@update')->name('shop.update');
    //Produk
    Route::get('shop/product', 'ProductController@index')->name('product.index');
    Route::get('shop/create', 'ProductController@create')->name('product.create');
    Route::get('shop/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('shop/product/store', 'ProductController@store')->name('product.store');
    Route::put('shop/product/update/{id}', 'ProductController@update')->name('product.update');
    Route::delete('shop/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
    //Kategori
    Route::get('shop/category', 'ShopProductCategoryController@index')->name('shopcategory.index');
    Route::post('shop/category/store', 'ShopProductCategoryController@store')->name('shopcategory.store');
    Route::put('shop/category/update/{id}', 'ShopProductCategoryController@update')->name('shopcategory.put');
    Route::delete('shop/category/destroy/{id}', 'ShopProductCategoryController@destroy')->name('shopcategory.destroy');
    //Booking
    Route::get('shop/booking', 'BookingController@indexPenjual')->name('booking.shop');
    Route::put('shop/booking/update/{id}', 'BookingController@update')->name('bookingupdate.shop');
    //Jadwal
    Route::get('shop/jadwal', 'JadwalController@indexPenjual')->name('jadwal.shop');
    Route::post('shop/jadwal/store', 'JadwalController@storeJadwalPenjual')->name('storejadwal.shop');
    Route::get('shop/jadwal/list', 'JadwalController@dataPenjual')->name('listjadwal.shop');
    //Chat
    Route::get('shop/chat', 'ChatController@indexPenjual')->name('chat.shop');
    Route::get('shop/chat/get/{id}', 'ChatController@getChatPenjual')->name('chatget.shop');
    Route::post('shop/chat/store', 'ChatController@storeSeller')->name('chatstore.shop');
    //Order
    Route::get('shop/order', 'OrderController@indexShop')->name('order.shop');
    Route::get('shop/oder/detail/{id}', 'OrderController@detailShop')->name('orderdetail.shop');
    Route::post('shop/order/verifikasiPembayaranUser', 'OrderController@verifikasiPembayaranUser')->name('verifikasipembayaran.shop');
});

//User Biasa
Route::get('user/home', 'HomeController@userIndex')->name('home.user');
Route::get('user/product/detail/{id}', 'ProductController@detailUser');
//Detail
Route::get('user/shop/{id}', 'ShopController@show')->name('home.detailshop');
Route::get('user/datajadwal/ajax/{id}', 'JadwalController@dataPenjualDetailPenjual')->name('getjadwalajax.user');
//Jadwal
Route::put('user/jadwal/update/{id}', 'JadwalController@plotJadwalUser')->name('plotjadwal.user');
Route::get('user/jadwal', 'JadwalController@indexUser')->name('jadwal.user');
//Bookmark
Route::get('user/bookmark', 'ProductBookmark@index')->name('bookmark.user');
Route::post('user/product/bookmark/add', 'ProductBookmark@store')->name('bookmarkadd.user');
Route::delete('use/bookmark/delete/{id}', 'ProductBookmark@destroy')->name('bookmarkdelete.user');
//cart
Route::post('user/product/cart/add', 'CartController@store')->name('cartadd.user');
Route::post('user/product/card/delete', 'CartController@destroy')->name('cartdestroy.user');
Route::get('user/cart', 'CartController@index')->name('cartindex.user');
Route::get('user/cart/ajax/notif', 'CartController@indexAjax')->name('cartindexajax.user');
Route::get('user/cart/ajax/halaman', 'CartController@indexAjaxHalaman')->name('cartindexajaxhalaman.user');
//Search
Route::get('user/product/search/{keyword?}/{fitler?}', 'ProductController@search')->name('productsearch.user');
//Booking
Route::post('user/booking/store', 'BookingController@store')->name('bookingstore.user');
Route::get('user/booking', 'BookingController@indexUser')->name('booking.user');
//Checkout
Route::get('user/checkout/{id}', 'CheckoutController@index')->name('checkout.user');
Route::post('user/checkout/store', 'CheckoutController@store')->name('checkoutstore.user');
//Alamat
Route::get('user/alamat', 'AlamatController@index')->name('alamat.user');
Route::post('user/alamat/store', 'AlamatController@store')->name('alamatstore.user');
Route::get('user/alamat/show/{id}', 'AlamatController@show')->name('alamatshow.user');
Route::put('user/alamat/update/{id}', 'AlamatController@update')->name('alamatupdate.user');
Route::delete('user/alamat/destroy/{id}', 'AlamatController@destroy')->name('alamatdestroy.user');
//Order
Route::get('user/order/detailUser/{id}', 'OrderController@detailUser')->name('detailorder.user');
Route::get('user/order', 'OrderController@indexUser')->name('order.user');
Route::put('user/bayar/update/{id}', 'OrderController@uploadBuktiBayarUser')->name('orderbayar.user');
//Review
Route::post('user/review/store/{id}', 'OrderController@storeReview')->name('storereview.user');
//Chat
Route::get('user/chat', 'ChatController@indexUser')->name('chat.user');
Route::post('user/chat/store', 'ChatController@storeUser')->name('chatstore.user');
Route::get('user/chat/get/{id}', 'ChatController@getChatUser')->name('chatget.user');

//Peta Covid
Route::get('user/petacovid', function () {
    return view('user_umum.petacovid');
});

Route::get('user/geolocation','GeolocationController@index')->name('geolocation.user');
Route::get('user/geolocation/data', 'GeolocationController@data')->name('geolocationdata.user');
Route::post('shop/order/ubahstatus', 'OrderController@ubahStatusOrder')->name('ubahstatusorder.shop');
