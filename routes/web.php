<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('register', [AuthController::class, 'register'])->name('register.show');
    Route::post('register', [AuthController::class, 'postRegister'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('order-history/{food_id}', [OrderController::class, 'history'])->name('orders.history');
    Route::resource('orders', OrderController::class);
});

