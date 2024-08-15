<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    return view('admin.index');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::get('/admin', function () {
//    return view('admin.index');
//})->middleware(['auth', 'verified'])->name('admin');

Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// ----------------- Permission -------------------- //
Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('permissions/{item}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::patch('permissions/{item}/update', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('permissions/{item}', [PermissionController::class, 'destroy'])->name('permissions.delete');

// ----------------- Role -------------------- //
Route::get('roles', [RoleController::class, 'index'])->name('role.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('role.create')->middleware('can:Создать роль');
Route::post('roles/store', [RoleController::class, 'store'])->name('role.store')->middleware('can:Создать роль');
Route::get('roles/{item}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('can:Редактировать роль');
Route::patch('roles/{item}/update', [RoleController::class, 'update'])->name('role.update')->middleware('can:Редактировать роль');
Route::delete('roles/{item}', [RoleController::class, 'destroy'])->name('role.delete')->middleware('can:Удалить роль');;
Route::get('roles/{item}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('add-permission-to-role');
Route::patch('roles/{item}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('give-permission-to-role');

Route::middleware('auth')->group(function () {

    // ----------------- Users -------------------- //
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('user.create')->middleware('can:Создать пользователя');
    Route::post('admin/users/store', [UserController::class, 'store'])->name('user.store')->middleware('can:Создать пользователя');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('can:Редактировать пользователя');
    Route::patch('admin/users/{user}', [UserController::class, 'update'])->name('user.update')->middleware('can:Редактировать пользователя');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('user.delete')->middleware('can:Удалить пользователя');

    // ----------------- Products -------------------- //
    Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('admin/products/store', [ProductController::class, 'store'])->name('product.store')->middleware('can:Создать товар');
    Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware('can:Редактировать товар');
    Route::patch('admin/products/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('can:Редактировать товар');
    Route::delete('admin/products/{product}', [ProductController::class, 'destroy'])->name('products.delete')->middleware('can:Удаление товара');;

    // ----------------- Operation -------------------- //
    Route::get('admin/operation', [OperationController::class, 'index'])->name('operation.index');
    Route::get('admin/operation/create', [OperationController::class, 'create'])->name('operation.create');
    Route::post('admin/operation/store', [OperationController::class, 'store'])->name('operation.store');
    Route::get('admin/operation/{operation}/edit', [OperationController::class, 'edit'])->name('operation.edit');
    Route::patch('admin/operation/{operation}', [OperationController::class, 'update'])->name('operation.update');
    Route::delete('admin/operation/{operation}', [OperationController::class, 'destroy'])->name('operation.delete');

    // ----------------- Cart -------------------- //
    Route::get('admin/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('admin/cart/filter', [CartController::class, 'filterCart'])->name('cart.filter');
    Route::get('admin/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::post('admin/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('admin/cart/{cart}/edit', [CartController::class, 'edit'])->name('cart.edit');
    Route::patch('admin/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('admin/cart/{cart}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::get('admin/cart/delete-item/', [CartController::class, 'deleteItem'])->name('cart.delete-item');
    Route::get('add-to-cart', [CartController::class, 'addProductToCart'])->name('add.product');
    Route::get('export-cart-exel', [CartController::class, 'exportCartExel'])->name('export-cart-exel');

    // ------------------ Storage ---------------- //
    Route::get('admin/stock', [ProductController::class, 'stock'])->name('stock.index');
    Route::get('admin/stock/{id}/reset', [ProductController::class, 'resetCount'])->name('stock.reset');

    // ------------------ Cash ---------------- //
    Route::get('admin/cash', [CashController::class, 'index'])->name('cash.index');
    Route::post('admin/cash', [CashController::class, 'store'])->name('cash.store');
    Route::get('admin/cash/{item}/edit', [CashController::class, 'edit'])->name('cash.edit');
    Route::patch('admin/cash/{item}', [CashController::class, 'update'])->name('cash.update');
    Route::delete('admin/cash/{item}', [CashController::class, 'destroy'])->name('cash.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



