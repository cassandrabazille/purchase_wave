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


// Utilisateurs



// Auth utilisateur (login, register, logout)
Route::controller(UserAuthController::class)->group(function () {
    Route::get('login', 'showLogin')->name('login');
    Route::post('login', 'doLogin')->name('login.post');
    Route::get('register', 'showRegister')->name('register');
    Route::post('register', 'doRegister')->name('register.post');
    Route::post('logout', 'logout')->name('logout');
});


// Profil utilisateur (protégé par middleware 'auth' par défaut)
// Groupe pour les utilisateurs connectés
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [UserProfileController::class, 'update'])->name('update');
    Route::post('/password', [UserProfileController::class, 'updatePassword'])->name('password');
});




// Admin
// routes/web.php



Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'showLogin')->name('login');
        Route::post('login', 'doLogin')->name('login.post');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::middleware(['auth:admin'])->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminProfileController::class, 'update'])->name('update');
        Route::post('/password', [AdminProfileController::class, 'updatePassword'])->name('password');
    });

});



//orders
Route::get('orders.index', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders.create', [OrderController::class, 'create'])->name('orders.create');
Route::post('orders.store', [OrderController::class, 'store'])->name('orders.store');
Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');


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
Route::post('/orderitems', [OrderItemController::class, 'store'])->name('orderitems.store');
Route::get('orderitems/{id}/edit', [OrderItemController::class, 'edit'])->name('orderitems.edit');
Route::put('orderitems/{id}', [OrderItemController::class, 'update'])->name('orderitems.update');
Route::get('orderitems/{id}', [OrderItemController::class, 'show'])->name('orderitems.show');
Route::delete('orderitems/{id}', [OrderItemController::class, 'destroy'])->name('orderitems.destroy');


//dashboard
Route::get('dashboard.index', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('index/status', [DashboardController::class, 'showStatus'])->name('dashboard.index.status');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/{user_id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/{user_id}/update', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{user_id}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

