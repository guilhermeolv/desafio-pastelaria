<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('clientes')->group(function () {
    Route::controller(ClienteController::class)->group(function () {
        Route::name('clientes.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::patch('/{id}', 'update')->name('update');
        });
    });
});

Route::prefix('produtos')->group(function () {
    Route::controller(ProdutoController::class)->group(function () {
        Route::name('produtos.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('', 'store')->name('store');
            Route::post('/{id}', 'update')->name('update');
            Route::patch('/{id}', 'update')->name('update');
        });
    });
});

Route::prefix('pedidos')->group(function () {
    Route::controller(PedidoController::class)->group(function () {
        Route::name('pedidos.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::patch('/{id}', 'update')->name('update');
            Route::get('{pedidos}/produtos', 'showProducts')->name('showProducts');
            Route::get('{pedidos}/clientes', 'showCostumers')->name('showCostumers');
        });
    });
});