<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemTypeController;
use App\Http\Controllers\NoteItemController;
use App\Http\Controllers\GoogleSocialiteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Pubilc route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/callback/google', [GoogleSocialiteController::class, 'handleCallback']);
});

//Protected route
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('test', ['', function () {
        return 'Test';
    }]);

    //ITEM
    Route::get('getItems', [ItemsController::class, 'get']);
    Route::get('getItems/{id}', [ItemsController::class, 'getID']);
    Route::post('postItems', [ItemsController::class, 'post']);
    Route::put('updateItems', [ItemsController::class, 'update']);
    Route::delete('deleteItems/{id}', [ItemsController::class, 'delete']);

    //ITEM_TYPE
    Route::get('getItemsType', [ItemTypeController::class, 'get']);
    Route::get('getItemsType/{id}', [ItemsController::class, 'getID']);
    Route::post('postItemsType', [ItemTypeController::class, 'post']);
    Route::put('updateItemsType', [ItemTypeController::class, 'update']);
    Route::delete('deleteItemsType/{id}', [ItemTypeController::class, 'delete']);

    //NOTE_ITEM
    Route::get('getNote', [NoteItemController::class, 'get']);
    Route::get('getNote/{id}', [NoteItemController::class, 'getID']);
    Route::post('postNote', [NoteItemController::class, 'post']);
    Route::put('updateNote', [NoteItemController::class, 'update']);
    Route::delete('deleteNote/{id}', [NoteItemController::class, 'delete']);

    //BOOKING
    Route::get('getBooking', [ItemsController::class, 'get']);
    Route::post('postBooking', [ItemsController::class, 'post']);
});
