<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
   Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', 'CouponController@index')->name('index');        
        Route::get('data', 'CouponController@data')->name('data');
        Route::get('create', 'CouponController@create')->name('create');
        Route::post('create', 'CouponController@store')->name('store');
   });
});


Route::group(['as' => 'students.'], function () {
    Route::group(['prefix' => 'tai-khoan', 'as' => 'account.', 'middleware' => ['auth:students', 'verified', 'user.block']], function () {

        Route::prefix('/coupon')->group(function () {
            Route::post('/verify', 'CouponController@verify');
            Route::post('/remove', 'CouponController@remove');
            Route::post('/polling', 'CouponController@pollingCoupon');
        });
    });
});