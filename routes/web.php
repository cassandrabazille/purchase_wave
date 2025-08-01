<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProfileController;

// Route principale

Route::get('/', function () {
    return redirect()->route('login');
});

// Users

Route::controller(UserAuthController::class)->group(function () {
    Route::get('login', 'showLogin')->name('login');
    Route::post('login', 'doLogin')->name('login.post');
    Route::get('register', 'showRegister')->name('register');
    Route::post('register', 'doRegister')->name('register.post');
    Route::post('logout', 'logout')->name('logout');
});


// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware(['auth'])->group(function () {

    // Routes liées au profil utilisateur (édition, mise à jour, mot de passe)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [UserProfileController::class, 'update'])->name('update');
        Route::post('/password', [UserProfileController::class, 'updatePassword'])->name('password');
    });

    // Routes CRUD pour les commandes
    Route::resource('orders', OrderController::class);

    // Routes CRUD pour les catégories/ produits/ fournisseurs/ lignes de commande/ tableau de bord
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('orderitems', OrderItemController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

});


// Admin

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'showLogin')->name('login');
        Route::post('login', 'doLogin')->name('login.post');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::middleware(['auth:admin'])->group(function () {

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
            Route::post('/update', [AdminProfileController::class, 'update'])->name('update');
            Route::post('/password', [AdminProfileController::class, 'updatePassword'])->name('password');
        });

        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/{user_id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::patch('/{user_id}/update', [AdminController::class, 'update'])->name('update');
        Route::delete('/{user_id}/destroy', [AdminController::class, 'destroy'])->name('destroy');

    });

});



