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

Route::group(['prefix' => 'packages', 'as' => 'packages.'], function () {
    // package routes
    Route::get('/', [\App\Http\Controllers\Backend\PackageController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Packages'), route('admin.packages.index'));
        });

    Route::get('create', [\App\Http\Controllers\Backend\PackageController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.packages.index')
                  ->push(__('Create Package'), route('admin.packages.create'));
        });

    // category routes
    Route::get('/category', [\App\Http\Controllers\Backend\PackageCategoryController::class, 'index'])
        ->name('category.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Category Packages'), route('admin.packages.category.index'));
        });

    Route::get('category/create', [\App\Http\Controllers\Backend\PackageCategoryController::class, 'create'])
        ->name('category.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.packages.category.index')
                  ->push(__('Create Category Package'), route('admin.packages.category.create'));
        });
});

Route::group(['prefix' => 'consultation', 'as' => 'consultation.'], function () {
    Route::get('/', [\App\Http\Controllers\Backend\ConsultationController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Consultations'), route('admin.consultation.index'));
        });

    Route::get('show/{consultation}', [\App\Http\Controllers\Backend\ConsultationController::class, 'show'])
        ->name('show')
        ->breadcrumbs(function (Trail $trail, $consultation) {
            $trail->parent('admin.consultation.index')
                  ->push(__('Consultation Details'), route('admin.consultation.show', $consultation));
        });
});

Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    Route::get('/', [\App\Http\Controllers\Backend\ContactUsController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Contact Us'), route('admin.contact.index'));
        });

    Route::get('show/{contact}', [\App\Http\Controllers\Backend\ContactUsController::class, 'show'])
        ->name('show')
        ->breadcrumbs(function (Trail $trail, $contact) {
            $trail->parent('admin.contact.index')
                  ->push(__('Contact Details'), route('admin.contact.show', $contact));
        });
});

Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
    Route::get('home', function () {
        return view('backend.settings.home');
    })
        ->name('home')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                  ->push(__('Home Settings'), route('admin.settings.home'));
        });
});
