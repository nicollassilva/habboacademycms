<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Web') 
    ->group(function() {

        Route::get('/', 'AcademyController@index')->name('academy.index');
        Route::get('/topic/{id}/{slug}', 'Topic\TopicController@show')->name('topics.show');
        
        Route::prefix('user')
            ->middleware('auth')
            ->group(function() {

            Route::get('/edit', 'UserController@edit')->name('users.edit');

            Route::get('/topics/me', 'UserController@topics')->name('topics.me');
            Route::get('/topics/create', 'Topic\TopicController@create')->name('topics.create');
            Route::post('/topics', 'Topic\TopicController@store')->name('topics.store');
            Route::post('/topic/{id}/{slug}/comment', 'Topic\CommentController@store')->name('topics.comments.store');

        });

});

Auth::routes();
