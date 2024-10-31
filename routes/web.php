<?php

use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', function () {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [MonitoringController::class, 'index'])->name('apps.index');
    Route::prefix('user')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('apps.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('apps.user.create');
        // Route::get('/edit', [UserController::class, 'edit'])->name('apps.user.edit');
        Route::get('/get_permissions', [UserController::class, 'get_permissions'])->name('apps.user.get_permissions');
        Route::get('/my_profile', [UserController::class, 'my_profile'])->name('apps.user.my_profile');
        Route::get('/{id}', [UserController::class, 'edit'])->name('apps.user.edit');
        Route::post('/', [UserController::class, 'store'])->name('apps.user.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('apps.user.update');
    });

    Route::prefix('role')->group(function (){
        Route::get('/', [RoleController::class, 'index'])->name('apps.role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('apps.role.create');
        Route::get('/{id}', [RoleController::class, 'edit'])->name('apps.role.edit');
        Route::post('/', [RoleController::class, 'store'])->name('apps.role.store');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('apps.role.update');
    });

    Route::prefix('permission')->group(function (){
        Route::get('/', [PermissionController::class, 'index'])->name('apps.permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('apps.permission.create');
        Route::get('/{id}', [PermissionController::class, 'edit'])->name('apps.permission.edit');
        Route::post('/', [PermissionController::class, 'store'])->name('apps.permission.store');
        Route::post('/update/{id}', [PermissionController::class, 'update'])->name('apps.permission.update');
    });

    Route::prefix('customer')->group(function (){
        Route::get('/', [CustomerController::class, 'index'])->name('apps.customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('apps.customer.create');
        Route::get('/{id}', [CustomerController::class, 'edit'])->name('apps.customer.edit');
        Route::post('/', [CustomerController::class, 'store'])->name('apps.customer.store');
        Route::post('/branch', [CustomerController::class, 'store_branch'])->name('apps.customer.store_branch');
    });
});
