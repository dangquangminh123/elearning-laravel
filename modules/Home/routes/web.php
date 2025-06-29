<?php

use Illuminate\Support\Facades\Route;

// Route::prefix('home')->name('home.')->group(function () {
//    //Route here
// });

// Route::group(['as' => 'home'], function () {
   Route::get('/', function () {
       return '<h1>Home</h1>';
   })->name('home');
// });