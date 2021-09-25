<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;


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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'cache cleared!!';
});

// Route::view('/admin', 'admin.dashboard.index');
// Route::view('/admin/login', 'admin.auth.login');

Auth::routes();

Route::view('/', 'site.pages.homepage');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

//ADD TO CART//
Route::post('/product/add/cart', [ProductController::class, 'addToCart'])->name('product.add.cart');
Route::get('/cart', [CartController::class, 'getCart'])->name('checkout.cart');
Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('checkout.cart.clear');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    Route::get('checkout/payment/complete', [CheckoutController::class, 'complete'])->name('checkout.payment.complete');
    Route::get('account/orders', [AccountController::class, 'getOrders'])->name('account.orders');

});
require 'admin.php';


