<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\TenantManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Mail\SendTenantProjCredsMail;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

require __DIR__ . '/tenant.php';

// register user
Route::get('/register', function() {
    return view('registration.registration');
})->name('get_registration_page');
Route::post('/register', [AuthController::class, 'registration'])->name('register_user');

// login user
Route::get('/login', function() {
    return view('registration.login');
})->middleware(['check_subdomain', 'guest'])->name('get_login_page');
Route::post('/login', [AuthController::class, 'login'])->name('login_user');

// routes related to admin and tenant controllers
Route::middleware('auth')->group(function() {
    // return to admin or tenant home page if authenticated
    Route::get('/', function() {
        return redirect()->route('get_admin_dashboard_page');
    })->name('get_home_page');

    // admin logic controller
    Route::get('/admin', [AdminController::class, 'index'])->name('get_admin_dashboard_page');

    // user management CRUD
    Route::resource('/admin/users', UserManagementController::class);

    // tenant management CRUD
    Route::resource('/admin/tenants', TenantManagementController::class);

    // logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout_user');
});
