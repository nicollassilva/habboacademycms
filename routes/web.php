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

Route::group([
    'namespace' => 'App\Http\Controllers\Web',
    'as' => 'habboacademy.'
], function() {
    Route::get('/', 'AcademyController@index')->name('index');
    Route::get('/topic/{id}/{slug}', 'Topic\TopicController@show')->name('topics.show');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Web',
    'as' => 'habboacademy.',
    'middleware' => ['auth'],
    'prefix' => 'user'
], function() {
    Route::get('/topics/create', 'Topic\TopicController@create')->name('topics.create');
    Route::post('/topics', 'Topic\TopicController@store')->name('topics.store');
    Route::post('/topic/{id}/{slug}/comment', 'Topic\CommentController@store')->name('topics.comments.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
