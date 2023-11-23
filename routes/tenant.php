<?php

use App\Http\Controllers\Tenant\CategoryController;
use App\Http\Controllers\Tenant\ProductController;
use App\Http\Controllers\Tenant\TenantController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::domain('{tenant_subdomain}.inventory_multi_tenant.test')->middleware(['check_subdomain'])->group(function() {
    Route::middleware(['auth', 'set_tenant_db_connection'])->group(function() {
        Route::get('/', function(Request $req) {
            return redirect()->route('get_tenant_dashboard_page', ['tenant_subdomain' => $req->subdomain]);
        });

        // tenant logic controller
        Route::get('/tenant', [TenantController::class, 'index'])->name('get_tenant_dashboard_page');

        // tenant categories CRUD
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // tenant products CRUD
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});