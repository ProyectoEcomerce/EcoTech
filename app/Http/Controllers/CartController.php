<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function showCart()
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Asegúrate de que el usuario tiene un carrito
        $cart = $user->cart;

        if (!$cart) {
            // Manejar el caso en que el usuario no tiene un carrito aún
            $products = collect(); // Devolver una colección vacía
        } else {
            $products = $cart->products; // Obtener los productos del carrito
        }

        return view('cart.show', compact('products'));
    }


    public function addItem(Request $request)
    {
        $product = Product::find($request->product_id); 

        if (!$product) {
            return back()->withErrors(['subtype' => 'El producto no existe'])->withInput();
        }

        $user = auth()->user();

        $cart = $user->cart ?? new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        if($cart->products()->where('product_id' , $product->id)->exists()){
            $amount=$cart->products()->where('product_id', $product->id)->first()->pivot->amount;
            $newAmount= $amount+1;
            $cart->products()->updateExistingPivot($product->id, ['amount' => $newAmount]);
            return back()->with('mensaje', 'El producto ya está en el carrito');
        }else{
            $cart->products()->attach($product->id, ['amount' => 1]);
            return back()->with('mensaje', 'Producto añadido con éxito');
        }
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

    public function purchase(Request $request)
    {
        $user = auth()->user();

        $cart = $user->cart;
        if ($cart) {
            Mail::to($user->email)->send(new OrderConfirmation($cart));
            $cart->products()->detach();
            $cart->save();

            return back()->with('success', 'Los productos han sido comprados correctamente');
        }

        return back()->withErrors('No hay un carrito para comprar.');
    }
}


