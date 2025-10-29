<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Frontend\OrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

/*
 * Frontend Routes
 */

  Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Route::group(['as' => 'frontend.'], function () {
        includeRouteFiles(__DIR__.'/frontend/');
    });

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('livewire/update', $handle);
    });
});

Route::any('finish-payment', [OrderController::class, 'finishPayment'])->name('finish-payment');
Route::any('fallback-finish-payment', [OrderController::class, 'fallbackFinishPayment'])->name('fallback-finish-payment');

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
], function () {
    Route::get('payment-success/{order_number}', [CallbackController::class, 'successReturnUrl'])->name('redirect.payment.success');
    Route::get('payment-failed/{order_number}', [CallbackController::class, 'failureReturnUrl'])->name('redirect.payment.failed');
    Route::get('payment-expired/{order_number}', [CallbackController::class, 'expirationReturnUrl'])->name('redirect.payment.expired');
});
