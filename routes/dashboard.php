<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| This routes have a prefix name adm.
|
| Example: ->name('topics.search') is 'adm.topics.search'
|
*/

/**
 * Topics Comments
 */
Route::any('/topic/{id}/comments/search', 'TopicCommentController@search')->name('topic.comments.search');
Route::put('/topic/{id}/comment/{idComment}', 'TopicCommentController@updated')->name('topic.comments.updated');
Route::get('/topic/{id}/comment/{idComment}/edit', 'TopicCommentController@edit')->name('topic.comments.edit');
Route::get('/topic/{id}/comment/{idComment}/show', 'TopicCommentController@show')->name('topic.comments.show');
Route::get('/topic/{id}/comments', 'TopicController@comments')->name('topic.comments');

/**
 * Topics Routes
 */
Route::any('topics/search', 'TopicController@search')->name('topics.search');
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
        Route::any('/articles/categories/search', 'ArticleCategoryController@search')->name('categories.search');
        Route::resource('categories', 'ArticleCategoryController');
        Route::any('/search', 'ArticleController@search')->name('search');
    });

Route::resource('articles', 'ArticleController');

Route::get('/', 'DashboardController@index')->name('dashboard.index');