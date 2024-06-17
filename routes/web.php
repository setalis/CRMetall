<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {

    // ----------------- Users -------------------- //
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('admin/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('admin/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('user.delete');

    // ----------------- Products -------------------- //
    Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('admin/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('admin/products/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('admin/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');

    // ----------------- Operation -------------------- //
    Route::get('admin/operation', [OperationController::class, 'index'])->name('operation.index');
    Route::get('admin/operation/create', [OperationController::class, 'create'])->name('operation.create');
    Route::post('admin/operation/store', [OperationController::class, 'store'])->name('operation.store');
    Route::get('admin/operation/{operation}/edit', [OperationController::class, 'edit'])->name('operation.edit');
    Route::patch('admin/operation/{operation}', [OperationController::class, 'update'])->name('operation.update');
    Route::delete('admin/operation/{operation}', [OperationController::class, 'destroy'])->name('operation.delete');

    // ----------------- Cart -------------------- //
    Route::get('admin/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('admin/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::post('admin/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('admin/cart/{cart}/edit', [CartController::class, 'edit'])->name('cart.edit');
    Route::patch('admin/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('admin/cart/{cart}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('admin/cart', [CartController::class, 'deleteItem'])->name('cart.delete-item');
    Route::get('add-to-cart', [CartController::class, 'addProductToCart'])->name('add.product');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
