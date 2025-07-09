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

Route::get('login', [AuthController::class, 'showlogin'])->name('auth.showLogin');
Route::post('login', [AuthController::class, 'doLogin'])->name('auth.login');
Route::get('register', [AuthController::class, 'showRegister'])->name('auth.showRegister');;
Route::post('register', [AuthController::class, 'doRegister'])->name('auth.register');
Route::get('orders.index', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders.create', [OrderController::class, 'create'])->name('orders.create');
Route::get('orders.store', [OrderController::class, 'store'])->name('orders.store');
Route::get('categories.index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories.create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('categories.store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('products.index', [ProductController::class, 'index'])->name('products.index');
Route::get('products.create', [ProductController::class, 'create'])->name('products.create');


Route::get('/test-vue', function () {
    return view('test');
});