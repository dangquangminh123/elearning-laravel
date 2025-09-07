<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'AboutController@index')->name('about');
Route::get('/learning-path', 'LearningController@index')->name('learning-path');
Route::get('/recruit-ment', 'RecruitmentController@index')->name('recruit-ment');

