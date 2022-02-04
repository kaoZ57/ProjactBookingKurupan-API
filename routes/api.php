<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
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

//ITEM
Route::get('/getItems', [ItemsController::class, 'get']);
Route::get('/getItems/{id}', [ItemsController::class, 'getID']);
Route::post('/postItems', [ItemsController::class, 'post']);
Route::put('/updateItems', [ItemsController::class, 'update']);
Route::delete('/deleteItems/{id}', [ItemsController::class, 'delete']);

//BOOKING
Route::get('/getBooking', [ItemsController::class, 'get']);
Route::post('/postBooking', [ItemsController::class, 'post']);
