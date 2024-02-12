<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Models\Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/pedidos', function () {
    return view('pedidos');
});

Route::get('/cancelar-pedido', function () {
    return view('cancelar-pedido');
});

Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth', 'verified');

Fortify::verifyEmailView(function () {
    return view('auth.verify-email');
});



Route::middleware('admin')->group(function(){
    Route::get('adminProduct', [ProductController::class, 'adminIndex'])->name('admin.index');
    Route::post('createProduct', [ProductController::class, 'create'])->name('layouts.createProduct');
    Route::put('edit_product/{id}', [ProductController::class, 'update'])->name('layouts.updateProduct');
    Route::delete('delete_product/{id}', [ProductController::class, 'delete'])->name('layouts.deleteProduct');
});

Route::get('/', [ProductController::class, 'getProducts']); //Mostrar productos

Route::middleware('auth', 'verified')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('additem', [CartController::class, 'addItem'])->name('cart.additem');
    Route::post('clearcart', [CartController::class, 'clearCart'])->name('cart.clearcart');
    Route::post('removeitem', [CartController::class, 'removeItem'])->name('cart.removeitem');
    Route::post('updateAmount', [CartController::class, 'updateItemAmount'])->name('cart.updateAmount');
    Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::post('manageWishlist', [WishlistController::class, 'manageWishlist'])->name('wish.additem');
});

Route::get('product/{id}' , [ProductController::class, 'showProduct'])->name('show.item');

Route::get('locale/{locale}', function($locale){
    session()->put('locale', $locale);
    return Redirect::back();
});