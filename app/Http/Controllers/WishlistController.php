<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function manageWishlist(Request $request){
        $product =Product::find($request->product_id); 

        if (!$product) {
            return back()->withErrors(['subtype' => 'El producto no existe'])->withInput();
        }

        $user = auth()->user();

        $wishlist = $user->wishlist ?? new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->save();

        if($wishlist->product()->where('product_id' , $product->id)->exists()){
            $wishlist->product()->detach($product);
            return back()->with('mensaje', 'El producto se ha eliminado de la lista');
        }else{
            $wishlist->product()->attach($product->id);
            return back()->with('mensaje', 'Producto añadido con éxito');
        }
    }
}
