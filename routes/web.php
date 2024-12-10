<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdController;



Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Products
Route::resource('products', ProductController::class)->middleware('auth');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

// Order routes
Route::post('/order', [OrderController::class, 'store'])->name('order.store')->middleware('auth');
Route::get('/order-history', [OrderController::class, 'history'])->name('order.history')->middleware('auth');
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->middleware('auth')->name('orders.updateStatus');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

// Ads routes
Route::get('/ads', [AdController::class, 'index'])->name('ads.index')->middleware('auth');
