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

//GET ITEM
Route::get('/getItems', [ItemsController::class, 'getItems']);

Route::get('/getItems/{id}', [ItemsController::class, 'getItemsID']);

//POST ITEM
Route::post('/postItems', [ItemsController::class, 'postItems']);

//UPDATE
Route::put('/updateItems', [ItemsController::class, 'updateItems']);


//DALETE
Route::delete('/deleteItems/{id}', [ItemsController::class, 'deleteItem']);
