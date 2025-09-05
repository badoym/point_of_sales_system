<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InvetoryController;
use App\Http\Controllers\MealTypeController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('product/{product}/update', [ProductController::class, 'update'])->name('product.update');
        Route::delete('product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destory');
        Route::get('product/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('product.toggleStatus');

        Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('supplier/{supplier}/update', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('supplier/{supplier}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');
        Route::get('supplier/{id}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('supplier.toggleStatus');

        Route::get('mealtype', [MealTypeController::class, 'index'])->name('mealtype.index');
        Route::get('mealtype/create', [MealTypeController::class, 'create'])->name('mealtype.create');
        Route::post('mealtype/store', [MealTypeController::class, 'store'])->name('mealtype.store');
        Route::get('mealtype/{mealtype}/edit', [MealTypeController::class, 'edit'])->name('mealtype.edit');
        Route::put('mealtype/{mealtype}/update', [MealTypeController::class, 'update'])->name('mealtype.update');
        Route::delete('mealtype/{mealtype}/destroy', [MealTypeController::class, 'destroy'])->name('mealtype.destroy');
        Route::get('mealtype/{id}/toggle-status', [MealTypeController::class, 'toggleStatus'])->name('mealtype.toggleStatus');

        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/{order_number}/view', [TransactionController::class, 'view'])->name('transaction.view');
        Route::delete('transaction/{transaction}/destroy', [TransactionController::class, 'destroy'])->name('transaction.destroy');
        Route::delete('transaction/{order_number}/destroy_sumorder', [TransactionController::class, 'destroy_sumorder'])->name('transaction.destroy_sumorder');
        
        
        Route::get('inventory', [InvetoryController::class, 'index'])->name('inventory.index');

        Route::get('/sales', [SalesReportController::class, 'index'])->name('sales.report.index');
        Route::get('sales/{order_number}/view', [SalesReportController::class, 'view'])->name('sales.report.view');

    });

    //Cashier routes
    Route::middleware('cashier')->prefix('cashier')->name('cashier.')->group(function () {
        Route::get('/', [CashierController::class, 'index'])->name('checkout.index'); 
        Route::post('/store', [CashierController::class, 'store'])->name('checkout.store');

        Route::get('/sales', [CashierController::class, 'sales'])->name('sales.sales');
        Route::get('/sales/{order_number}/view', [CashierController::class, 'view'])->name('sales.view');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
