<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


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

        if ($cart->products()->where('product_id', $product->id)->exists()) {
            $amount = $cart->products()->where('product_id', $product->id)->first()->pivot->amount;
            $newAmount = $amount + 1;
            $cart->products()->updateExistingPivot($product->id, ['amount' => $newAmount]);
            return back()->with('mensaje', 'El producto ya está en el carrito');
        } else {
            $cart->products()->attach($product->id, ['amount' => 1]);
            return back()->with('mensaje', 'Producto añadido con éxito');
        }
    }

    public function updateItemAmount(Request $request)
    {
        $productId = $request->input('product_id');
        $amountChange = $request->input('amount_change');

        $user = auth()->user();

        $cart = $user->cart;

        $currentQuantity = $cart->products()->where('product_id', $productId)->value('amount');
        $newAmount = max(0, $currentQuantity + $amountChange);

        if ($newAmount === 0) {
            $cart->products()->detach($productId);
            return back()->with('mensaje', 'Producto eliminado del carrito');
        }

        $cart->products()->updateExistingPivot($productId, ['amount' => $newAmount]);

        $message = $amountChange > 0 ? 'Cantidad aumentada con éxito' : 'Cantidad disminuida con éxito';
        return back()->with('mensaje', $message);
    }


    public function removeItem(Request $request)
    {

        $product = Product::find($request->input('product_id'));
        $user = auth()->user();
        $cart = $user->cart;
        if ($product) {
            $cart->products()->detach($product);
            return back()->with('success', 'Producto eliminado exitosamente');
        } else {
            return back()->with('error', 'No se encontro el producto');
        }
    }

    public function clearCart(Request $request)
    {

        $cart = Cart::find($request);

        $cart->product()->detach();
        return redirect('home')->with('success', 'Se han eliminado los productos');
    }

    public function purchase(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart;
        Log::info('Iniciando proceso de compra');

        if ($cart) {
            DB::beginTransaction();
            try {
                // Calcular el total del precio de los productos en el carrito
                $totalPrice = $cart->products->reduce(function ($carry, $product) {
                    return $carry + ($product->pivot->amount * $product->price);
                }, 0);

                Log::info('Productos en el carrito: ' . $cart->products->count());


                // Crear un nuevo pedido
                $order = Order::create([
                    'total_price' => $totalPrice,
                    'status' => 'pendiente', // Estado inicial del pedido
                    'user_id' => $user->id
                ]);

                // Asociar los productos del carrito con el pedido y registrar cantidades
                foreach ($cart->products as $product) {
                    DB::table('orders_products')->insert([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'amount' => $product->pivot->amount,
                    ]);
                }

                Mail::to($user->email)->send(new OrderConfirmation($cart));

                // Vaciar el carrito
                $cart->products()->detach();

                DB::commit();
                Log::info('Compra completada con éxito');


                // Enviar correo electrónico de confirmación


                return back()->with('success', 'Los productos han sido comprados correctamente');
            } catch (\Exception $e) {
                DB::rollback();
                // Considera loguear el error con Log::error($e);
                return back()->withErrors('Hubo un problema al procesar tu compra.');
            }
        }

        return back()->withErrors('No hay un carrito para comprar.');
    }
}
