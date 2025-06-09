<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
    Route::get('/', [\App\Http\Controllers\Backend\ServicesController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Services'), route('admin.services.index'));
        });

    Route::get('create', [\App\Http\Controllers\Backend\ServicesController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.services.index')
                  ->push(__('Create Service'), route('admin.services.create'));
        });

    Route::post('store', [\App\Http\Controllers\Backend\ServicesController::class, 'store'])
        ->name('store');

    Route::get('edit/{service}', [\App\Http\Controllers\Backend\ServicesController::class, 'edit'])
        ->name('edit')
        ->breadcrumbs(function (Trail $trail, $service) {
            $trail->parent('admin.services.index')
                  ->push(__('Edit Service'), route('admin.services.edit', $service));
        });

    Route::put('update/{service}', [\App\Http\Controllers\Backend\ServicesController::class, 'update'])
        ->name('update');
});

Route::group(['prefix' => 'services-category', 'as' => 'services-category.'], function () {
    Route::get('/', [\App\Http\Controllers\Backend\ServicesCategoryController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
              ->push(__('Services category'), route('admin.services-category.index'));
    });

    Route::get('create', [\App\Http\Controllers\Backend\ServicesCategoryController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.services-category.index')
                  ->push(__('Create Service'), route('admin.services-category.create'));
        });

    Route::post('store', [\App\Http\Controllers\Backend\ServicesCategoryController::class, 'store'])
        ->name('store');
});
