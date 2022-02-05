<?php

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
    Route::get('furnis/values', function (Request $request) {
        if($request->search) {
            return FurniValue::latest()->where('name', 'LIKE', "%{$request->search}%")->paginate(9);
        }

        return FurniValue::latest()->paginate(9);
    });

    // Last Badges API Route
    Route::get('badges/latest', function (Request $request) {
        if($request->search) {
            return Badge::latest()->where('title', 'LIKE', "%{$request->search}%")->paginate(9);
        }

        return Badge::latest()->paginate(9);
    });
    
});