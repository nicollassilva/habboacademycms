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
Route::namespace('Topic')
    ->group(function() {
        /**
         * Topics Comments
         */
        Route::any('/topics/comments/search', 'CommentController@search')->name('topics.comments.search');
        Route::delete('/topics/comment/{id}', 'CommentController@destroy')->name('topics.comments.destroy');
        Route::put('/topics/comment/{id}', 'CommentController@update')->name('topics.comments.update');
        Route::get('/topics/comment/{id}/edit', 'CommentController@edit')->name('topics.comments.edit');
        Route::get('/topics/comment/{id}/show', 'CommentController@show')->name('topics.comments.show');
        Route::get('/topics/comments', 'CommentController@index')->name('topics.comments.index');
         
        /**
         * Topic Comments
         */
        Route::any('/topic/{id}/comments/search', 'TopicCommentController@search')->name('topic.comments.search');
        Route::put('/topic/{id}/comment/{idComment}', 'TopicCommentController@update')->name('topic.comment.update');
        Route::get('/topic/{id}/comment/{idComment}/edit', 'TopicCommentController@edit')->name('topic.comment.edit');
        Route::get('/topic/{id}/comment/{idComment}/show', 'TopicCommentController@show')->name('topic.comment.show');
        Route::get('/topic/{id}/comments', 'TopicController@comments')->name('topic.comments');
        
        /**
         * Topics Routes
         */
        Route::any('topics/search', 'TopicController@search')->name('topics.search');
        Route::resource('topics', 'TopicController');
    });

/**
 * Slides Routes
 */
Route::any('slides/search', 'SlideController@search')->name('slides.search');
Route::resource('slides', 'SlideController');

/**
 * Articles Routes
 */
Route::namespace('Article')
    ->group(function() {
        Route::prefix('articles')
            ->name('articles.')
            ->group(function() {
                Route::any('/articles/categories/search', 'ArticleCategoryController@search')->name('categories.search');
                Route::resource('categories', 'ArticleCategoryController');
                Route::any('/search', 'ArticleController@search')->name('search');
            });

        Route::resource('articles', 'ArticleController');
    });

/**
 * Dashboard Index
 */
Route::get('/', 'DashboardController@index')->name('dashboard.index');