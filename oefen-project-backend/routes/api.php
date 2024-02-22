<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWarehouseController;
use App\Http\Controllers\WarehouseController;
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

Route::prefix('products')
    ->name('products.')
    ->group(function() {
        Route::prefix('{product}')
            ->group(function(){
                Route::prefix('warehouses')
                    ->name('warehouses.')
                    ->group(function() {
                        Route::prefix('{warehouse}')
                            ->group(function(){
                                Route::post('/', [ProductWarehouseController::class, 'store'])
                                    ->name('store');

                                Route::put('/', [ProductWarehouseController::class, 'update'])
                                    ->name('update');
                            });

                       Route::get('/', [ProductWarehouseController::class, 'index'])
                        ->name('index');
                    });
            });
    });
Route::apiResource('products', ProductController::class);
Route::apiResource('warehouse',WarehouseController::class);
