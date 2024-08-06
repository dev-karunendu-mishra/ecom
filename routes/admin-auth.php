<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CatalogController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth','verified'])->group(function(){ 

        Route::resource('categories', CategoryController::class)->names([
            'index' => 'categories',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy'
        ]);

        Route::resource('brands', BrandController::class)->names([
            'index' => 'brands',
            'create' => 'brands.create',
            'store' => 'brands.store',
            'show' => 'brands.show',
            'edit' => 'brands.edit',
            'update' => 'brands.update',
            'destroy' => 'brands.destroy'
        ]);

        Route::resource('products', ProductController::class)->names([
            'index' => 'products',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy'
        ]);

        Route::resource('/settings', SettingController::class)->names([
            'index' => 'settings',
            'create' => 'settings.create',
            'store' => 'settings.store',
            'show' => 'settings.show',
            'edit' => 'settings.edit',
            'update' => 'settings.update',
            'destroy' => 'settings.destroy'
        ]);

        Route::get('/sliders', [SliderController::class, 'index'])->name('sliders');
        Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');

        // Route::get('/pages', [PageController::class, 'index'])->name('pages');
        // Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        // Route::post('/pages', [PageController::class, 'store'])->name('pages.store');

        Route::resource('pages', PageController::class)->names([
            'index' => 'pages',
            'create' => 'pages.create',
            'store' => 'pages.store',
            'show' => 'pages.show',
            'edit' => 'pages.edit',
            'update' => 'pages.update',
            'destroy' => 'pages.destroy'
        ]);
        
        Route::resource('enquiries', EnquiryController::class)->names([
            'index' => 'enquiries',
            'create' => 'enquiries.create',
            'store' => 'enquiries.store',
            'show' => 'enquiries.show',
            'edit' => 'enquiries.edit',
            'update' => 'enquiries.update',
            'destroy' => 'enquiries.destroy'
        ]);
        

        Route::resource('blogs', BlogController::class)->names([
            'index' => 'blogs',
            'create' => 'blogs.create',
            'store' => 'blogs.store',
            'show' => 'blogs.show',
            'edit' => 'blogs.edit',
            'update' => 'blogs.update',
            'destroy' => 'blogs.destroy'
        ]);
        

        Route::resource('catalogs', CatalogController::class)->names([
            'index' => 'catalogs',
            'create' => 'catalogs.create',
            'store' => 'catalogs.store',
            'show' => 'catalogs.show',
            'edit' => 'catalogs.edit',
            'update' => 'catalogs.update',
            'destroy' => 'catalogs.destroy'
        ]);
        // Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        // Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    });
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
