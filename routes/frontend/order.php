<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;

Route::group(['middleware' => 'auth', 'prefix' => 'order', 'as' => 'order.'], function() {
    Route::get('package', [OrderController::class, 'package'])->name('package');
    Route::get('{order_number}', [OrderController::class, 'index'])->name('index');
    Route::get('payment/{order_number}', [OrderController::class, 'payment_pivot'])->name('payment');
    Route::get('payment/{order_number}/status', [OrderController::class, 'status'])->name('payment.status');
    Route::post('payment/store', [OrderController::class, 'paymentStore'])->name('payment.store');
    Route::get('finish-payment/{order_id}', [OrderController::class, 'finishPayment'])->name('finish');
    Route::post('payment/status', [OrderController::class, 'paymentStatus'])->name('payment.status');
});

Route::group(['middleware' => 'auth'], function() {
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
