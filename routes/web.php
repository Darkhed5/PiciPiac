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
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->middleware('auth')->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth')->name('products.destroy');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::patch('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');

Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/order', [OrderController::class, 'store'])->name('order.store')->middleware('auth');
<<<<<<< HEAD
=======
Route::resource('products', ProductController::class);
>>>>>>> 5f4345b7bdb3d240c8187a2c29f7fb82ecddc084
Route::get('/order-history', [OrderController::class, 'history'])->name('order.history')->middleware('auth');
