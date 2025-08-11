<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');        
        Route::get('data', 'OrderController@data')->name('data');
        Route::get('{id}/edit', 'OrderController@edit')->name('edit');
        Route::get('{id}', 'OrderController@show')->name('show');
        Route::post('{id}/update-status', 'OrderController@updateStatus')->name('update-status');
    });
});

Route::group(['as' => 'orders.'], function () {
    Route::post('/proceed-order', 'Clients\OrderController@proceed')->name('proceed');
    Route::get('/confirm', 'Clients\OrderController@confirm')->name('confirm')->middleware('auth:students');;
});

