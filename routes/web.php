<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

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

Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth','verified');

Fortify::verifyEmailView(function(){
    return view('auth.verify-email');
});

Route::get('/adminProduct', function(){
    return view('layouts.adminProduct');
});

Route::post('additem', [CartController::class, 'addItem'])->name('cart.additem');
Route::post('clearcart', [CartController::class, 'clearCart'])->name('cart.clearcart');
Route::post('removeitem', [CartController::class, 'removeItem'])->name('cart.removeitem');


Route::post('create', [ProductController::class, 'create'])->name('product.create');
Route::post('update', [ProductController::class, 'update'])->name('product.update');
Route::post('delete', [ProductController::class, 'delete'])->name('product.delete');