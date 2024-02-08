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
})->middleware('auth', 'verified');

Fortify::verifyEmailView(function () {
    return view('auth.verify-email');
});

Route::get('/', [ProductController::class, 'getProducts']);
Route::get('create_Product', [ProductController::class, 'createProduct']);

Route::post('additem', [CartController::class, 'addItem'])->name('cart.additem');
Route::post('clearcart', [CartController::class, 'clearCart'])->name('cart.clearcart');
Route::post('removeitem', [CartController::class, 'removeItem'])->name('cart.removeitem');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');


Route::get('adminProduct', [ProductController::class, 'adminIndex'])->name('admin.index');
Route::post('createProduct', [ProductController::class, 'create'])->name('layouts.createProduct');
Route::get('edit_product/{id}', [ProductController::class, 'edit'])->name('layouts.editProduct');
Route::put('edit_product/{id}', [ProductController::class, 'update'])->name('layouts.updateProduct');
Route::delete('delete_product/{id}', [ProductController::class, 'delete'])->name('layouts.deleteProduct');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
