<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;

Route::group(['middleware' => ['auth', config('boilerplate.access.middleware.verified')], 'prefix' => 'order', 'as' => 'order.'], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('payment/{order_number}', [OrderController::class, 'payment_pivot'])->name('payment');
});

Route::group(['middleware' => ['auth', config('boilerplate.access.middleware.verified')]], function() {
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('store', [CartController::class, 'store'])->name('store');
        Route::delete('destroy', [CartController::class, 'destroy'])->name('destroy');
    });
});

// Route::group(['middleware' => 'auth', 'prefix' => 'payment', 'as' => 'payment.'], function() {
//     Route::post('callback', function (Request $request) {
//         return response()->json(['message' => 'success']);
//     });
// });
