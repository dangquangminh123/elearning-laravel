<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->name('cart.')->group(function () {
   Route::post('/add', 'CartController@add')->name('add');  
   Route::get('/popup-items', 'CartController@getPopupItems')->name('popup');
   Route::get('/list', 'CartController@list')->name('list');  
   Route::post('/remove', 'CartController@remove')->name('remove'); // Xoá từng item
   Route::post('/clear', 'CartController@clear')->name('clear');    // Xoá tất cả
});