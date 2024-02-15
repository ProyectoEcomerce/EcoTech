<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddressController;
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

Route::get('/categorias', function () {
    return view('categorias');
});

Fortify::verifyEmailView(function () {
    return view('auth.verify-email');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('admin')->group(function () {
    Route::get('adminProduct', [ProductController::class, 'adminIndex'])->name('admin.index');
    Route::post('createProduct', [ProductController::class, 'create'])->name('layouts.createProduct');
    Route::put('edit_product/{id}', [ProductController::class, 'update'])->name('layouts.updateProduct');
    Route::delete('delete_product/{id}', [ProductController::class, 'delete'])->name('layouts.deleteProduct');

    Route::get('adminCategory', [CategoryController::class, 'adminIndex'])->name('admin.index');
    Route::post('createCategory', [CategoryController::class, 'create'])->name('layouts.createCategory');
    Route::put('edit_category/{id}', [CategoryController::class, 'update'])->name('layouts.updateCategory');
    Route::delete('delete_category/{id}', [CategoryController::class, 'delete'])->name('layouts.deleteCategory');
    Route::post('/categories/{category}/add-products', [CategoryController::class, 'addProducts'])->name('category.addProducts');
    Route::post('categories/{category}/remove-products', [CategoryController::class, 'removeProducts'])->name('category.removeProducts');

    Route::get('/categorias-productos', [ProductController::class, 'index'])->name('categorias.productos');

});

Route::get('/', [ProductController::class, 'getProducts']); //Mostrar productos

Route::middleware('auth', 'verified')->group(function(){
    Route::post('additem', [CartController::class, 'addItem'])->name('cart.additem');
    Route::post('clearcart', [CartController::class, 'clearCart'])->name('cart.clearcart');
    Route::post('removeitem', [CartController::class, 'removeItem'])->name('cart.removeitem');
    Route::post('updateAmount', [CartController::class, 'updateItemAmount'])->name('cart.updateAmount');
    Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::post('manageWishlist', [WishlistController::class, 'manageWishlist'])->name('wish.additem');

    //ORDERS
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
    Route::get('/orders/{order}', [OrderController::class, 'view'])->name('orders.view')->middleware('auth');
    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel')->middleware('auth');
    Route::put('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice')->middleware('auth');

    // Ruta para generar la factura de un pedido como PDF (no funciona)
    //Route::post('/invoice/{order}', [OrderController::class, 'generateInvoice'])->name('orders.invoice');


    //ADDRESSES

    // Ruta para mostrar todas las direcciones del usuario autenticado
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.adresses')->middleware('auth');

    // Ruta para mostrar el formulario de creación de una nueva dirección
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create')->middleware('auth');

    // Ruta para almacenar una nueva dirección
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store')->middleware('auth');

    // Ruta para mostrar el formulario de edición de una dirección existente
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit')->middleware('auth');

    // Ruta para actualizar una dirección existente
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update')->middleware('auth');

    // Ruta para borrar una dirección existente
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy')->middleware('auth');

    //ACCOUNT
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');

    // Ruta para mostrar el formulario de cambio de contraseña
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth');

    // Ruta para procesar el cambio de contraseña
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.updatePassword')->middleware('auth');

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('custom.logout');
});

Route::get('product/{id}', [ProductController::class, 'showProduct'])->name('show.item');

Route::get('wishlist', [WishlistController::class, 'showWishlist'])->name('show.wishlist');

Route::get('locale/{locale}', [AccountController::class, 'changeLocal'])->name('changeLanguage');
