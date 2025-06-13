<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\ChargeController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('harga', [ChargeController::class, 'index'])
    ->name('harga');

Route::get('tentang-kami', [AboutController::class, 'index'])
    ->name('about');


Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
