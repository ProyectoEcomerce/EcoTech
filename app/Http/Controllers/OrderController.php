<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get(); // Obtiene todos los pedidos del usuario autenticado y los ordena por el más reciente

        return view('orders.orders', compact('orders')); // Retorna la vista ubicada en resources/views/orders/orders.blade.php
    }
}
