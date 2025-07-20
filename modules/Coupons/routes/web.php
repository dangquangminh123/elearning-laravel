<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
   Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', 'CouponController@index')->name('index');        
        Route::get('data', 'CouponController@data')->name('data');
        Route::get('create', 'CouponController@create')->name('create');
        Route::post('create', 'CouponController@store')->name('store');
        Route::get('edit/{coupon}', 'CouponController@edit')->name('edit');
        Route::put('edit/{coupon}', 'CouponController@update')->name('update');
        Route::delete('delete/{coupon}', 'CouponController@delete')->name('delete');
   });
});


// Route::group( ['as' => 'students.'], function () {
    Route::group(['prefix' => 'tai-khoan', 'as' => 'account.', 'middleware' => ['auth:students', 'verified', 'user.block']], function () {

        Route::prefix('/coupon')->group(function () {
            Route::post('/verify', 'Clients\CouponController@verify');
            Route::post('/remove', 'Clients\CouponController@remove');
            Route::post('/polling', 'Clients\CouponController@pollingCoupon');
        });
    });
// });