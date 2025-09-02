<?php

use App\Http\Controllers\Frontend\OrderController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function() {

    Route::get('payment', [OrderController::class, 'payment'])->name('payment');

    Route::get('package', [OrderController::class, 'package'])->name('package');
});
