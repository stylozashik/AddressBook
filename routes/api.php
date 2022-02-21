<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ApiContactsController;
use App\Http\Controllers\ContactController;

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

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'getContactIndex']);
    Route::get('/{contact}', [ContactController::class, 'getContact']);
    Route::put('/{contact}', [ContactController::class, 'putContact']);
    Route::delete('/{contact}', [ContactController::class, 'deleteContact']);
    Route::post('/', [ContactController::class, 'postContact']);
    // Route::get('/', [ApiContactsController::class, 'getIndex']);
    // Route::get('/{contact}', [ApiContactsController::class, 'getItem']);
    // Route::put('/{contact}', [ApiContactsController::class, 'putItem']);
    // Route::delete('/{contact}', [ApiContactsController::class, 'deleteItem']);
    // Route::post('/', [ApiContactsController::class, 'postItem']);
});

Route::prefix('addresses')->group(function () {
    //Route::get('/', [ContactController::class, 'getAddressIndex']);
    Route::get('/{address}', [ContactController::class, 'getAddress']);
    Route::put('/{address}', [ContactController::class, 'putAddress']);
    Route::delete('/{address}', [ContactController::class, 'deleteAddress']);
    Route::post('/', [ContactController::class, 'postAddress']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
