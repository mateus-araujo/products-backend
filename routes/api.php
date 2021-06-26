<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', ProductController::class)->except(['index']);
Route::apiResource('products', ProductController::class)->only(['index']);

Route::get('product/{id}/history', [ProductController::class, 'history']);

Route::post('products/bulk/create', [ProductController::class, 'bulkStore']);
Route::post('products/bulk/update', [ProductController::class, 'bulkUpdate']);
