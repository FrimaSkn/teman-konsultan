<?php

use App\Http\Controllers\Backend\OrderController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('create', [OrderController::class, 'create'])->name('create');

    Route::post('store', [OrderController::class, 'store'])->name('store');

    Route::group(['prefix' => '{order}'], function() {
        Route::get('edit', [OrderController::class, 'edit'])->name('edit');
        Route::patch('update', [OrderController::class, 'update'])->name('update');
        Route::delete('destroy', [OrderController::class, 'destroy'])->name('destroy');
    });

});
