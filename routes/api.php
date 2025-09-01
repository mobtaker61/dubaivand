<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Articles
Route::prefix('v1')->group(function () {
    // Articles API
    Route::apiResource('articles', ArticleController::class);

    // Categories API
    Route::apiResource('categories', CategoryController::class);

    // Additional Article endpoints
    Route::get('articles/category/{category}', [ArticleController::class, 'getByCategory']);
    Route::get('articles/search/{query}', [ArticleController::class, 'search']);
    Route::get('articles/featured', [ArticleController::class, 'getFeatured']);
    Route::get('articles/breaking', [ArticleController::class, 'getBreaking']);
    Route::get('articles/latest', [ArticleController::class, 'getLatest']);
    Route::get('articles/popular', [ArticleController::class, 'getPopular']);

    // Article actions
    Route::post('articles/{article}/view', [ArticleController::class, 'incrementView']);
    Route::post('articles/{article}/feature', [ArticleController::class, 'toggleFeature']);
    Route::post('articles/{article}/breaking', [ArticleController::class, 'toggleBreaking']);
});
