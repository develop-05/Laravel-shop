<?php

use App\Http\Controllers\Admin\CategoryContoller;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ControllersProductController::class, 'index'])->name('home');
Route::post('/add', [ControllersProductController::class, 'add'])->name('card.add');
Route::get('/filter', [ControllersProductController::class, 'filter'])->name('products.filter');



Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::post('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');


Route::middleware('guest')->group(function() {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::get('/products/basket', [ProductController::class, 'basket'])->name('admin.products.basket');

    Route::get('/products/basket/{product}/restore', [ProductController::class, 'basketRestore'])->name('admin.products.basket.restore');
    Route::delete('/products/basket/{product}/delete', [ProductController::class, 'basketRemove'])->name('admin.products.basket.remove');


    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryContoller::class);
    Route::resource('/users', AdminUserController::class);
});

