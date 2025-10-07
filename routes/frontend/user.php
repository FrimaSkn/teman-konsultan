<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.home')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
        Route::get('/', [\App\Http\Controllers\Frontend\User\TransactionController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.user.dashboard')
                    ->push(__('Transactions'), route('frontend.user.transaction.index'));
            });

        Route::get('/{order_number}', [\App\Http\Controllers\Frontend\User\TransactionController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, $order_number) {
                $trail->parent('frontend.user.transaction.index')
                    ->push("Detail", route('frontend.user.transaction.show', $order_number));
            });
    });

    Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {
        Route::get('/', [\App\Http\Controllers\Frontend\User\SubcriptionController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.user.dashboard')
                    ->push(__('Transactions'), route('frontend.user.transaction.index'));
            });

        Route::get('/{order}', [\App\Http\Controllers\Frontend\User\SubcriptionController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, $order) {
                $trail->parent('frontend.user.transaction')
                    ->push(__('Transaction') . ' #' . $order->order_number, route('frontend.user.transaction.show', $order));
            });
    });

});
