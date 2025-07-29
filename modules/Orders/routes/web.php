<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('/proceed-order', 'Clients\OrderController@proceed')->name('proceed');
    Route::get('/confirm', 'Clients\OrderController@confirm')->name('confirm')->middleware('auth:students');;
});

