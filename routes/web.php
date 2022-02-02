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
Route::get('/', 'AcademyController@index')->name('academy.index');
Route::get('/topic/{id}/{slug}', 'TopicController@show')->name('topics.show');
Route::get('/article/{id}/{slug}', 'ArticleController@show')->name('articles.show');

Route::prefix('user')
    ->middleware('auth')
    ->group(function() {

    // User Update routes
    Route::get('/edit', 'UserController@edit')->name('users.edit');
    Route::put('/update', 'UserController@update')->name('users.update')->middleware('api');
    Route::put('/forumUpdate', 'UserController@forumUpdate')->name('users.forumUpdate')->middleware('api');

    // Forum routes
    Route::get('/topics/me', 'UserController@topics')->name('topics.me');
    Route::get('/topics/create', 'TopicController@create')->name('topics.create');
    Route::post('/topics', 'TopicController@store')->name('topics.store')->middleware('api');
    Route::post('/topic/{id}/{slug}/comment', 'Topic\TopicCommentController@store')->name('topics.comments.store');

    // User notifications
    Route::get('/notifications', 'User\NotificationController@index')->name('users.notifications.index');
    Route::delete('/notifications/deleteAll', 'User\NotificationController@destroyAll')->name('users.notifications.deleteAll');
    Route::delete('/notifications/{id}/delete', 'User\NotificationController@destroy')->name('users.notifications.delete');
    
});

Auth::routes();
