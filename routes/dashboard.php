<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

/**
 * Topics Routes
 */
Route::resource('topics', 'TopicController');

/**
 * Slides Routes
 */
Route::any('slides/search', 'SlideController@search')->name('slides.search');
Route::resource('slides', 'SlideController');

/**
 * Articles Routes
 */
Route::prefix('articles')
    ->name('articles.')
    ->group(function() {
        Route::resource('categories', 'ArticleCategoryController');
        Route::any('/search', 'ArticleController@search')->name('search');
    });

Route::resource('articles', 'ArticleController');

Route::get('/', 'DashboardController@index')->name('dashboard.index');