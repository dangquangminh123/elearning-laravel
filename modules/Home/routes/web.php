<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'AboutController@index')->name('about');
Route::get('/learning-path', 'LearningController@index')->name('learning-path');
Route::get('/knowledge', 'KnowledgeController@index')->name('know-ledge');

Route::get('/recruit-ment', 'RecruitmentController@index')->name('recruit-ment');

