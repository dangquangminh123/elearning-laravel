<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\Admin\LoginController;


    Route::get( '/login', "Admin\LoginController@showLoginForm")->name('login');
    Route::post( '/login', action: "Admin\LoginController@login")->name('login');
    Route::post( '/logout', action: "Admin\LoginController@logout")->name('logout');