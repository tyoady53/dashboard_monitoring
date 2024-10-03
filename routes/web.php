<?php

use App\Http\Controllers\MonitoringController;
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
});
