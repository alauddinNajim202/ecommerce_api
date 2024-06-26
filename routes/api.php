<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//  __user routes__
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);



//  __categories routes__
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);


// sub_categories route
Route::get('/categories/{category_id}/subcategories', [SubCategoryController::class,'index']);
Route::post('/categories/{category_id}/subcategories', [SubCategoryController::class,'store']);
Route::get('/categories/{category_id}/subcategories/{id}', [SubCategoryController::class,'show']);
Route::put('/categories/{category_id}/subcategories/{id}', [SubCategoryController::class, 'update']);
Route::delete('/categories/{category_id}/subcategories/{id}', [SubCategoryController::class, 'destroy']);




// products route
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);


// customers route
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index']);
Route::post('/customers', [App\Http\Controllers\CustomerController::class, 'store']);
Route::get('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'show']);
Route::put('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'update']);
Route::delete('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'destroy']);


// orders route
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']);
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store']);
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show']);
Route::put('/orders/{id}', [App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy']);
