<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CostumeController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AccessoryController;
use App\Http\Controllers\API\CostumePictController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/costume', [CostumeController::class, 'fetch']);
Route::post('/costume', [CostumeController::class, 'store']);
Route::put('/costume/{id}', [CostumeController::class, 'update']);
Route::delete('/costume/{id}', [CostumeController::class, 'delete']);

Route::get('/accessory', [AccessoryController::class, 'fetch']);
Route::post('/accessory', [AccessoryController::class, 'store']);
Route::put('/accessory/{id}', [AccessoryController::class, 'update']);
Route::delete('/accessory/{id}', [AccessoryController::class, 'delete']);

Route::get('/category', [CategoryController::class, 'fetch']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);

Route::post('/costume-pict', [CostumePictController::class, 'store']);

Route::get('order', [OrderController::class, 'fetch']);
Route::post('order', [OrderController::class, 'store']);
Route::post('order/confirm', [OrderController::class, 'konfirmasi']);
Route::post('order/return', [OrderController::class, 'pengembalian']);
Route::get('order/costume-check', [OrderController::class, 'costumeCheck']);
Route::get('order/{id}', [OrderController::class, 'fetchByCode']);
