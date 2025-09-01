<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'AboutController@index')->name('about');