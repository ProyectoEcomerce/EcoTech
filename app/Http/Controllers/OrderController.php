<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get(); // Obtiene todos los pedidos del usuario autenticado y los ordena por el más reciente

        return view('orders.orders', compact('orders')); // Retorna la vista ubicada en resources/views/orders/orders.blade.php
    }

    public function cancel(Request $request, Order $order)
    {
        // Asegúrate de que el usuario autenticado sea el propietario del pedido
        if ($order->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para realizar esta acción.');
        }

        // Cambiar el estado del pedido a "cancelado"
        $order->status = 'cancelado';
        $order->save();

        // Redireccionar al usuario con un mensaje de éxito
        return back()->with('success', 'El pedido ha sido cancelado con éxito.');
    }

    public function view(Order $order)
    {
        $order->load('products'); // Carga los productos  con el pedido
        return view('orders.viewOrder', compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load('products'); // Carga los productos con el pedido
        $order->load('products', 'user.addresses');

        return view('orders.invoice', compact('order'));
    }

    public function generateInvoice(Order $order)
    {
        $pdf = PDF::loadView('invoices.view', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }

}
