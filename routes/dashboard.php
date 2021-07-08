<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard.index');

Route::prefix('articles')
    ->name('articles.')
    ->group(function() {
        Route::resource('categories', 'ArticleCategoryController');
    });
    
Route::resource('articles', 'ArticleController');