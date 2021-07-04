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
    'as' => 'habboacademy'
], function() {
    Route::get('/', 'AcademyController@index')->name('index');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Web',
    'as' => 'habboacademy.',
    'middleware' => ['auth'],
    'prefix' => 'user'
], function() {
    Route::get('/topics/create', 'TopicController@create')->name('topics.create');
    Route::post('/topics', 'TopicController@store')->name('topics.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
