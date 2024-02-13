<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function showWishlist(){
        $user = auth()->user();
        $wishlist = Wishlist::where('user_id', $user->id)->first();
        if($wishlist){
            $products = $wishlist->product()->paginate(10);
            return view('wishlist', compact('products'));
        }else{
            return view('wishlist')->with('error', 'No se encontró la lista de deseos para este usuario.');
        }
    }

    public function manageWishlist(Request $request){
        $product =Product::find($request->product_id); 

        if (!$product) {
            return back()->withErrors(['subtype' => 'El producto no existe'])->withInput();
        }else{
            DB::beginTransaction();
            try{
                $user = auth()->user();

                $wishlist = $user->wishlist ?? new Wishlist();
                $wishlist->user_id = $user->id;
                $wishlist->save();
        
                if($wishlist->product()->where('product_id' , $product->id)->exists()){
                    $wishlist->product()->detach($product);
                    $product->decrement('favouriteCounter');
                    DB::commit();
                    return back()->with('mensaje', 'El producto se ha eliminado de la lista');
                }else{
                    $wishlist->product()->attach($product->id);
                    $product->increment('favouriteCounter');
                    DB::commit();
                    return back()->with('mensaje', 'Producto añadido con éxito');
                }
            }catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors('Algo falló al procesar la lista de deseos.');
            }           
        }
    }
}
