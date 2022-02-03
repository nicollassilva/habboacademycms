<?php

use Illuminate\Support\Facades\Route;

// Index route
Route::get('/', 'AcademyController@index')->name('academy.index');

// Login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/client/flash', 'ClientController@flash')->name('client.flash');

// Register
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// User Logout
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

// Global routes
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

    // User notification routes
    Route::get('/notifications', 'User\NotificationController@index')->name('users.notifications.index');
    Route::delete('/notifications/deleteAll', 'User\NotificationController@destroyAll')->name('users.notifications.deleteAll');
    Route::delete('/notifications/{id}/delete', 'User\NotificationController@destroy')->name('users.notifications.delete');
    
});