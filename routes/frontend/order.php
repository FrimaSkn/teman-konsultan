<?php

use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;

Route::group(['middleware' => 'auth', 'prefix' => 'order', 'as' => 'order.'], function() {
    Route::get('package', [OrderController::class, 'package'])->name('package');
    Route::get('payment/{order_number}', [OrderController::class, 'payment'])->name('payment');
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

// cart
