<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//login & register
Route::get('login', [AuthController::class, 'showlogin'])->name('auth.showLogin');
Route::post('login', [AuthController::class, 'doLogin'])->name('auth.login');
Route::get('register', [AuthController::class, 'showRegister'])->name('auth.showRegister');;
Route::post('register', [AuthController::class, 'doRegister'])->name('auth.register');

//orders
Route::get('orders.index', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders.create', [OrderController::class, 'create'])->name('orders.create');
Route::get('orders.store', [OrderController::class, 'store'])->name('orders.store');

//categories
Route::get('categories.index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories.create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories.store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//products
Route::get('products.index', [ProductController::class, 'index'])->name('products.index');
Route::get('products.create', [ProductController::class, 'create'])->name('products.create');
Route::post('products.store', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

//supplier
Route::get('suppliers.index', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('suppliers.create', [SupplierController::class, 'create'])->name('suppliers.create');
Route::post('suppliers.store', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::get('suppliers/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

//orderitem
Route::get('orderitems.index', [OrderItemController::class, 'index'])->name('orderitems.index');
Route::get('orderitems.create', [OrderItemController::class, 'create'])->name('orderitems.create');
Route::post('orderitems', [OrderItemController::class, 'store'])->name('orderitems.store');
Route::get('orderitems/{id}/edit', [OrderItemController::class, 'edit'])->name('orderitems.edit');
Route::put('orderitems/{id}', [OrderItemController::class, 'update'])->name('orderitems.update');
Route::get('orderitems/{id}', [OrderItemController::class, 'show'])->name('orderitems.show');
Route::delete('orderitems/{id}', [OrderItemController::class, 'destroy'])->name('orderitems.destroy');
