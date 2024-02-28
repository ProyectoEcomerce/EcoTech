<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
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

    public function showBuyView(Request $request)
    {
        $user = auth()->user();
        $addresses = $user->addresses;
        $cart = $user->cart;
        $products = $cart->products;
        $totalAmount = $cart->getTotalAmount();
        $firstPaymentMethod = $user->paymentMethods()->first();
        $paymentMethods = $user->paymentMethods;
        $validCoupon = false;
        $couponSearch = 0;


        if($request->has('code')){
            $cuponIntroducido=$request->code;
            $coupons=Coupon::all();
    
            $couponSearch= $coupons->where('code', $cuponIntroducido)->first();
    
            if($couponSearch){
                if($couponSearch->usesCounter < $couponSearch->limitUses ){
                    $expirationDate= Carbon::parse($couponSearch->expiration);
    
                    if($expirationDate->isFuture()){
                        $validCoupon=true;
                    }else{
                        $validCoupon=false;

                    }
                }else{
                    $validCoupon=false;

                }
            }else{
                $validCoupon=false;

            }
        }

        if($request->has('cancel')){
            $validCoupon=false;
        }
        

        // Pasa las variables a la vista
        return view('orders.buy', compact('user', 'addresses', 'cart', 'products', 'totalAmount', 'validCoupon', 'couponSearch','firstPaymentMethod', 'paymentMethods'));
    }
}
