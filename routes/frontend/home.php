<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\ChargeController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\ConsultationController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('harga', [ChargeController::class, 'index'])
    ->name('harga');

Route::group([
    'prefix' => 'artikel',
    'as' => 'post.',
], function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('index');

    Route::get('{post}', [PostController::class, 'show'])
        ->name('show');
});

Route::get('tentang-kami', [AboutController::class, 'index'])
    ->name('about');

Route::get('hubungi-kami', [ContactUsController::class, 'index'])
    ->name('contact-us');

Route::post('hubungi-kami', [ContactUsController::class, 'store'])
    ->name('contact-us.store');

Route::group([
    'prefix' => 'free-consultation',
    'as' => 'free-consultation.',
], function () {
    Route::get('/', [ConsultationController::class, 'free_consultation'])
        ->name('index');

    Route::get('messages', [ConsultationController::class, 'messages'])
        ->name('messages');

    Route::post('store', [ConsultationController::class, 'store'])
        ->name('store');
});

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
