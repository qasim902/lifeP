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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [\App\Http\Controllers\api\OrderController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\api\OrderController::class, 'addOrEditOrder'])->name('store');
        Route::get('/show/{id?}', [\App\Http\Controllers\api\OrderController::class, 'show'])->name('show');
        Route::get('/{id}', [\App\Http\Controllers\api\OrderController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'products', 'as' => 'products-'], function () {
        Route::get('/', [\App\Http\Controllers\api\ProductController::class, 'index'])->name('index');
        Route::get('/show/{id?}', [\App\Http\Controllers\api\ProductController::class, 'show'])->name('show');
    });
});
