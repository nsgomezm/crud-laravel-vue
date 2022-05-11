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
    Route::get('/validCedula/{cedula}', 'getUserByCedula');
    Route::post('/', 'store');
    Route::post('/{user}', 'update');
    Route::delete('/{user}', 'destroy');
});
Route::prefix('products')->controller(\App\Http\Controllers\Product\ProductController::class)->group(function () {
    Route::get('/', 'getList');
    Route::post('/', 'store');
    Route::post('/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});
Route::prefix('bills')->controller(\App\Http\Controllers\Bill\BillController::class)->group(function () {
    Route::get('/', 'getList');
    Route::get('/{bill}', 'show');

    Route::post('/', 'store');
    // Route::post('/{product}', 'update');
    Route::delete('/{bill}', 'destroy');

});
Route::prefix('shoppings')->controller(\App\Http\Controllers\Shopping\ShoppingController::class)->group(function () {
    Route::get('/', 'getList');
    Route::post('/{product}', 'store');
    Route::post('/{product}/{shopping}', 'update');
    Route::delete('/{product}/{shopping}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
