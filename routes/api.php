<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CallbackController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'payment'], function () {
    Route::any('callback', [CallbackController::class, 'paymentCallback'])->name('payment.callback');
});
