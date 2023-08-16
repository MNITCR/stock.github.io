<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ProductModel;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PoControllerAPI;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/report',[PoControllerAPI::class,'SearchAPI']);
Route::get('/products', [ProductController::class, 'index']);
Route::put('/products/{proid}', [ProductController::class, 'updatePro']);
Route::post('products', [ProductController::class, 'store']);

// Route::put('/products/{proid}', [ProductController::class, 'updatePro']);
