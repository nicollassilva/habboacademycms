<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard.index');

Route::resource('articles', 'ArticleController');