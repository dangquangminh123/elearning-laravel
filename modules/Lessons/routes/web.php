<?php

use Illuminate\Support\Facades\Route;
use Modules\Lessons\src\Http\Controllers\LessonController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
   Route::prefix('lessons')->name('lessons.')->group(function () {
      Route::get('/{courseId}', "LessonController@index")->name('index');
      Route::get('/{courseId}/create', "LessonController@create")->name('create');
      Route::get('/{courseId}/data', "LessonController@data")->name('data');
      Route::post('/{courseId}/create', "LessonController@store");
      Route::get('/edit/{lessonId}', "LessonController@edit")->name('edit');
      Route::post('/edit/{lessonId}',  "LessonController@update")->name(name: 'update');
      Route::delete('/delete/{lessonId}',  "LessonController@delete")->name(name: 'delete');
      Route::get('/{courseId}/sort', "LessonController@sort")->name('sort');
      Route::post('/{courseId}/sort', "LessonController@handleSort");
   });
});

Route::group(['as' => 'lesson.', 'middleware' => ['auth:students', 'verified', 'user.block']], function () {
    Route::get('/bai-hoc/{slug}', "Clients\LessonController@index")->name('index');
});