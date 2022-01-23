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

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user.is.public']], function () {
    Route::get('/food/{type_id?}', [FoodController::class, 'index'])->where('id', '[0-9]+')->name('home');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('order-history/{food_id}', [OrderController::class, 'history'])->name('orders.history');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'user.is.admin']], function () {
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/{order}/confirm', [OrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/', 'welcome');
