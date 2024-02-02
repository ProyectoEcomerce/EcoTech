<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addItem(Request $request){

        $product= Product::find($request->id);

        if(!$product){
            return back()->withErrors(['subtype'=>'El producto no existe'])->withInput();
        }
        
        $user=auth()->user();

        $cart = $user->cart;

        $cart->product()->attach($request->id);

        $cart->save();

        return back()->with('mensaje', 'Producto añadido con exito');
    }

    public function removeItem(Request $request){

        $product= Product::find($request);
        $user=auth()->user();
        $cart = $user->cart;
        if($product){
            $cart->product()->detach($request);
            return redirect('home')->with('success', 'Producto eliminado exitosamente');
        }else{
            return redirect('home')->with('error', 'No se ha encontrado el producto');
        }
    }

    public function clearCart(Request $request){

        $cart= Cart::find($request);

        $cart->product()->detach();
        return redirect('home')->with('success', 'Se han eliminado los productos');
    }
}


