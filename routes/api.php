<?php

use App\Http\Controllers\Api\Auth\JwtController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ColorProductController;
use App\Http\Controllers\Api\InventoryProductController;
use App\Http\Controllers\Api\PhotoProductController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\SizeProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('authentication')->group(function () {
    Route::post('login', [JwtController::class, 'login']);
});

Route::group(['middleware' => 'jwt.auth'],function () {
    Route::prefix('products')->group(function () {
        Route::get('all',  [ProductController::class, 'index']);
        Route::get('consult/{slug}',  [ProductController::class, 'show']);
        Route::post('register',  [ProductController::class, 'store']);
        Route::put('update/{slug}',  [ProductController::class, 'update']);
        Route::delete('delete/{slug}',  [ProductController::class, 'destroy']);
    });

    Route::prefix('colors')->group(function () {
        Route::get('all',  [ColorController::class, 'index']);
        Route::get('consult/{id}',  [ColorController::class, 'show']);
        Route::post('register',  [ColorController::class, 'store']);
        Route::put('update/{id}',  [ColorController::class, 'update']);
        Route::delete('delete/{id}',  [ColorController::class, 'destroy']);
    });

    Route::prefix('sizes')->group(function () {
        Route::get('all',  [SizeController::class, 'index']);
        Route::get('consult/{id}',  [SizeController::class, 'show']);
        Route::post('register',  [SizeController::class, 'store']);
        Route::put('update/{id}',  [SizeController::class, 'update']);
        Route::delete('delete/{id}',  [SizeController::class, 'destroy']);
    });

    Route::prefix('inventory')->group(function () {
        Route::get('all',  [InventoryProductController::class, 'index']);
        Route::get('consult/{id}',  [InventoryProductController::class, 'show']);
        Route::post('register',  [InventoryProductController::class, 'store']);
        Route::put('update/{id}',  [InventoryProductController::class, 'update']);
        Route::delete('delete/{id}',  [InventoryProductController::class, 'destroy']);
    });

});
