<?php

use App\Models\Article\ArticleCategory;
use App\Models\Badge;
use App\Models\FurniValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('v1.')->prefix('v1')->group(function() {

    // Furni Values API Route
    Route::get('furnis/values', fn (Request $request) => FurniValue::resultsForApi($request->search));

    // Last Badges API Route
    Route::get('badges/latest', fn (Request $request) => Badge::resultsForApi($request->search));
    
});