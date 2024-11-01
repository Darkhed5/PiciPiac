<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth');
Route::get('/test-route', function () {
    return 'Test route is working!';
});

