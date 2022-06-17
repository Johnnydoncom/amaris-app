<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('cards', \App\Http\Livewire\Card\Home::class)->name('cards.index');
Route::get('cards/{slug}', \App\Http\Livewire\Card\Show::class)->name('cards.show');

// Card Checkout
Route::get('cards/{slug}/checkout', \App\Http\Livewire\Card\Checkout::class)->middleware(['verified_user','has_cart'])->name('cards.checkout');


Route::get('product/{slug}', \App\Http\Livewire\Product\Show::class)->name('product.show');

// Product Checkout
Route::get('order/checkout', \App\Http\Livewire\Checkout\Checkout::class)->middleware(['verified_user','has_cart'])->name('order.checkout');

// Order
Route::get('order/{slug}', \App\Http\Livewire\Checkout\Order::class)->name('order.index');

Route::get('order/{order}/success', function (\Illuminate\Http\Request $request, App\Models\Order $order){
    if (! $request->hasValidSignature()) {
        return redirect()->route('index');
    }
    return view('checkout-success', [
        'order' => $order
    ]);
})->middleware(['signed','verified', 'auth'])->name('checkout.success');

// Account routes
Route::prefix('account')->as('account.')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Account\AccountController::class, 'index'])->name( 'index');

    // Order
    Route::prefix('order')->as('order.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Account\OrderController::class, 'index'])->name('index');
        Route::get('details/{order_number}', [\App\Http\Controllers\Account\OrderController::class, 'show'])->name('show');
        Route::delete('details/{orderItem}/cancel', [\App\Http\Controllers\Account\OrderController::class, 'cancelItem'])->name('cancelItem');
        Route::get('details/{order_number}/download', [\App\Http\Controllers\Account\OrderController::class, 'download'])->name('download');

        Route::get('track/{order_number}', [\App\Http\Controllers\Account\OrderController::class, 'track'])->name('track');
    });

    Route::get('wishlist', [\App\Http\Controllers\Account\AccountController::class, 'wishlist'])->name('wishlist.index');
    Route::delete('wishlist/{wishlist}', [\App\Http\Controllers\Account\AccountController::class, 'destroyWishlist'])->name('wishlist.destroy');

    Route::get('transactions', [\App\Http\Controllers\Account\TransactionsController::class, 'index'])->name('transactions.index');

    Route::get('settings', [\App\Http\Controllers\Account\AccountController::class, 'edit'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Account\AccountController::class, 'update'])->name('settings.store');

    Route::get('password', [\App\Http\Controllers\Account\AccountController::class, 'editPassword'])->name('password.index');
    Route::post('password', [\App\Http\Controllers\Account\AccountController::class, 'updatePassword'])->name('password.store');

    Route::get('verification', \App\Http\Livewire\Account\Verification::class)->name('verification.index');

    Route::get('withdraw-request', [\App\Http\Controllers\Account\AccountController::class, 'withdrawRequest'])->name('withdraw.index');
    Route::post('withdraw-request', [\App\Http\Controllers\Account\AccountController::class, 'submitWithdrawRequest'])->name('withdraw.store');
});

Route::prefix('dashboard')->as('admin.')->middleware(['auth','verified', 'admin_auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

    Route::get('users/verifications', [\App\Http\Controllers\Admin\UserController::class, 'verifications'])->middleware('role:'.\App\Enums\UserRole::ADMIN.'|'.\App\Enums\UserRole::SUPERADMIN)->name('users.verifications.index');
    Route::get('users/verifications/{userVerification}', [\App\Http\Controllers\Admin\UserController::class, 'showVerification'])->middleware('role:'.\App\Enums\UserRole::ADMIN.'|'.\App\Enums\UserRole::SUPERADMIN)->name('users.verifications.show');
    Route::patch('users/verifications/{userVerification}', [\App\Http\Controllers\Admin\UserController::class, 'verificationAction'])->middleware('role:'.\App\Enums\UserRole::ADMIN.'|'.\App\Enums\UserRole::SUPERADMIN)->name('users.verifications.update');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('role:'.\App\Enums\UserRole::ADMIN.'|'.\App\Enums\UserRole::SUPERADMIN);


    Route::get('platforms', \App\Http\Livewire\Admin\PlatformController::class)->name('platforms.index');

    Route::get('categories', \App\Http\Livewire\Admin\ProductCategory\Home::class)->name('categories.index');

    // Giftcards
    Route::get('products/giftcards', \App\Http\Livewire\Admin\Card\Home::class)->name('cards.index');
    Route::get('products/giftcards/create', \App\Http\Livewire\Admin\Card\Create::class)->name('cards.create');
    Route::get('products/giftcards/{product}/edit', \App\Http\Livewire\Admin\Card\Edit::class)->name('cards.edit');

    // Products
    Route::get('products', \App\Http\Livewire\Admin\Product\Home::class)->name('products.index');
    Route::get('products/create', \App\Http\Livewire\Admin\Product\Create::class)->name('products.create');
    Route::get('products/{product}/edit', \App\Http\Livewire\Admin\Product\Edit::class)->name('products.edit');

//    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

    Route::post('/file-upload', [\App\Http\Controllers\Admin\DashboardController::class, 'fileUpload'])->name('file-upload');

    // Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->middleware('role:'.\App\Enums\UserRole::ADMIN.'|'.\App\Enums\UserRole::SUPERADMIN)->name('settings.index');

});

Route::get('clear-cache', function (){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return 'Cache clear';
})->name('clear-cache');

Route::get('down', function (){
    \Illuminate\Support\Facades\Artisan::call('down --secret=123456');
})->name('down');

Route::get('up', function (){
    \Illuminate\Support\Facades\Artisan::call('up');
})->name('up');

Route::get('migrate', function (){
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');
})->name('migrate');

Route::as('pages.')->group(function () {
    Route::get('products-services', [\App\Http\Controllers\PageController::class, 'products'])->name('products');
    Route::get('ninja-power-system', [\App\Http\Controllers\PageController::class, 'ninjaPower'])->name('ninja-power-system');

    Route::get('contact-us', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
    Route::post('contact-us', [\App\Http\Controllers\PageController::class, 'storeContact'])->name('contact.store');
    Route::get('about-us', [\App\Http\Controllers\PageController::class, 'about'])->name('about-us');
    Route::get('terms-conditions', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');
    Route::get('privacy-policy', [\App\Http\Controllers\PageController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('cookie-policy', [\App\Http\Controllers\PageController::class, 'cookiePolicy'])->name('cookie-policy');
    Route::get('return-refund-policy', [\App\Http\Controllers\PageController::class, 'refundPolicy'])->name('refund-policy');


    Route::get('website-design', [\App\Http\Controllers\PageController::class, 'webDesign'])->name('web-design');
    Route::get('graphic-design', [\App\Http\Controllers\PageController::class, 'graphicDesign'])->name('graphic-design');
    Route::get('content-creation', [\App\Http\Controllers\PageController::class, 'contentCreation'])->name('content-creation');
    Route::get('social-media-marketing', [\App\Http\Controllers\PageController::class, 'smm'])->name('social-media-marketing');

});

require __DIR__.'/auth.php';
