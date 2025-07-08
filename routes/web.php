<?php

use App\Http\Controllers\OrderController;
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