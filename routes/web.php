<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth');
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->middleware('auth');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');

// Útvonalak a rendeléshez
Route::post('/order', [OrderController::class, 'store'])->name('order.store')->middleware('auth');
Route::get('/order-history', [OrderController::class, 'history'])->name('order.history')->middleware('auth');
