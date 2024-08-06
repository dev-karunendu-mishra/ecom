<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\EnquiryController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/')->group(function(){
    Route::get('', [WebsiteController::class,'index']);
    
    // Route::get('contact', function () {
    //     return view('template-one.contact');
    // })->name('contact.create');

    // Route::post('contact', [WebsiteController::class,'submitEnquiry'])->name('contact.store');

     Route::resource('contact', EnquiryController::class)->names([
            'index' => 'contact',
            'create' => 'contact.create',
            'store' => 'contact.store',
            'show' => 'contact.show',
            'edit' => 'contact.edit',
            'update' => 'contact.update',
            'destroy' => 'contact.destroy'
        ]);

    // Route::get('categories', [CategoryController::class,'getCategories']);
    // Route::resource('products', ProductController::class);

    Route::get('shop', function () {
        return view('template-one.shop');
    });

    Route::get('products/{product}', [WebsiteController::class,'getProductData']);

    Route::get('cart', function () {
        return view('template-one.cart');
    });

    Route::get('checkout', function () {
        return view('template-one.checkout');
    });
    Route::get('categories/{category}', [WebsiteController::class,'getCategoryData']);
    Route::get('{page}', [WebsiteController::class,'getPage']);    
});
