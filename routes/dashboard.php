<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

/**
 * Slides Routes
 */
Route::resource('slides', 'SlideController');

/**
 * Articles Routes
 */
Route::prefix('articles')
    ->name('articles.')
    ->group(function() {
        Route::resource('categories', 'ArticleCategoryController');
    });
    
Route::resource('articles', 'ArticleController');

Route::get('/', 'DashboardController@index')->name('dashboard.index');