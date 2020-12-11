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

// Category Routes
Route::get('categories',  [App\Http\Controllers\Api\CategoryController::class, 'index'] );
Route::get('categories/{id}',  [App\Http\Controllers\Api\CategoryController::class, 'show'] );
Route::post('categories/create',  [App\Http\Controllers\Api\CategoryController::class, 'store'] );
Route::put('categories/update/{id}',  [App\Http\Controllers\Api\CategoryController::class, 'update'] );
Route::delete('categories/delete/{id}',  [App\Http\Controllers\Api\CategoryController::class, 'destroy'] );
