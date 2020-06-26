<?php

use App\Http\Controllers\Api\Auth\AuthClienController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\EvaluationApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;

Route::post('auth/register',[RegisterController::class,'store']);
Route::post('auth/token',[AuthClienController::class,'auth']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('auth/me',[AuthClienController::class,'me']);
    Route::post('auth/logout',[AuthClienController::class,'logout']);
    
    Route::post('auth/v1/orders/{identifyOrder}/evaluations',[EvaluationApiController::class,'store']);
    
    Route::get('auth/v1/my-orders',[OrderApiController::class,'myOrders']);
    Route::post('auth/v1/orders',[OrderApiController::class,'store']);
});




Route::prefix('v1')->group(function(){
    Route::get('tenants/{uuid}',[TenantApiController::class, 'show']);
    Route::get('tenants',[TenantApiController::class, 'index']);

    Route::get('categories/{identify}',[CategoryApiController::class,'show']);
    Route::get('categories',[CategoryApiController::class,'categoriesByTenant']);

    Route::get('tables/{identify}',[TableApiController::class,'show']);
    Route::get('tables',[TableApiController::class,'tablesByTenant']);

    Route::get('products/{identify}',[ProductApiController::class,'show']);
    Route::get('products',[ProductApiController::class,'productsByTenant']);
    
    
    
    Route::post('orders',[OrderApiController::class,'store']);
    Route::get('orders/{identify}',[OrderApiController::class,'show']);
});
