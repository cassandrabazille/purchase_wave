<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\CategorieController;
// use App\Http\Controllers\SupplierController;
// use App\Http\Controllers\ProduitController;

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
Route::put('categories.store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//products
Route::get('products.index', [ProductController::class, 'index'])->name('products.index');
Route::get('products.create', [ProductController::class, 'create'])->name('products.create');


