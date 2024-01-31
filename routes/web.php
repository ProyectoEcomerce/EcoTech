<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
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

Route::post('save_product', [CartController::class, 'saveProduct'])->name('save_product');