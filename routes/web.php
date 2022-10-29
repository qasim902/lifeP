<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth',
    'verified',
])->group(function () {

    Route::group(['prefix' => 'users','as' => 'users-'],function(){
        Route::get('/',[\App\Http\Controllers\UserController::class,'index'])->name('index');
        Route::post('/',[\App\Http\Controllers\UserController::class,'addOrEditOrder'])->name('store');
        Route::get('/show/{id?}',[\App\Http\Controllers\UserController::class,'show'])->name('show');
        Route::get('/{id}',[\App\Http\Controllers\UserController::class,'delete'])->name('delete');
    });

    Route::group(['prefix' => 'orders','as' => 'orders-'],function(){
        Route::get('/',[\App\Http\Controllers\OrderController::class,'index'])->name('index');
        Route::post('/',[\App\Http\Controllers\OrderController::class,'addOrEditOrder'])->name('store');
        Route::get('/show/{id?}',[\App\Http\Controllers\OrderController::class,'show'])->name('show');
        Route::get('/{id}',[\App\Http\Controllers\OrderController::class,'delete'])->name('delete');
    });

    Route::group(['prefix' => 'products','as' => 'products-'],function(){
        Route::get('/',[\App\Http\Controllers\ProductController::class,'index'])->name('index');
        Route::post('/',[\App\Http\Controllers\ProductController::class,'addOrEditProduct'])->name('store');
        Route::get('/show/{id?}',[\App\Http\Controllers\ProductController::class,'show'])->name('show');
        Route::get('/{id}',[\App\Http\Controllers\ProductController::class,'delete'])->name('delete');
    });


    Route::group(['prefix' => 'transactions','as' => 'transactions-'],function(){
        Route::get('/',[\App\Http\Controllers\TransactionController::class,'index'])->name('index');
        Route::post('/',[\App\Http\Controllers\TransactionController::class,'addOrEditTransaction'])->name('store');
        Route::get('/show/{id?}',[\App\Http\Controllers\TransactionController::class,'show'])->name('show');
        Route::get('/{id}',[\App\Http\Controllers\TransactionController::class,'delete'])->name('delete');
        Route::get('toggle/{id}',[\App\Http\Controllers\TransactionController::class,'toggleStatus'])->name('toggle');
    });

    Route::get('/dashboard', function (Request $request) {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



