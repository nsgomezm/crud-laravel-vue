<?php

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

Route::prefix('users')->controller(\App\Http\Controllers\User\UserController::class)->group(function () {
    Route::get('/', 'getList');
    Route::post('/', 'store');
    Route::delete('/{user}', 'destroy');
});
Route::prefix('products')->controller(\App\Http\Controllers\Product\ProductController::class)->group(function () {
    Route::get('/', 'getList');
    Route::post('/', 'store');
    Route::delete('/{product}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
