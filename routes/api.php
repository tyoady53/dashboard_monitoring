<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MonitoringController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('dashboard')->group(function (){
    Route::get('/get_branch/{cust_id}', [CustomerController::class, 'get_branch']);
    Route::get('/get_data/{email}', [MonitoringController::class, 'get_data']);
    Route::get('/random_data', [MonitoringController::class, 'create']);
    Route::post('/store', [MonitoringController::class, 'store']);

    // Route::post('/store', [MonitoringController::class, 'store']);
});
