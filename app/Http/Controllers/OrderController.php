<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        }else{
            DB::beginTransaction();
            try{
                // Cambiar el estado del pedido a "cancelado"
                $order->status = 'cancelado';
                $order->save();
                DB::commit();
                // Redireccionar al usuario con un mensaje de éxito
                return back()->with('success', 'El pedido ha sido cancelado con éxito.');
            }catch(\Exception $e){
                DB::rollBack();
                return back()->withErrors('No se pudo cancelar el pedido');
            }   
        }
    }
}
