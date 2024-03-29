<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function adminOffer() {
        $offers=Offer::paginate(6);
        $categories=Category::all();
        return view('layouts.adminOffer', compact('offers', 'categories'));
    }

    public function create(Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'type'=>'required',
                'applied'=>'required',
                'discount'=>'required|integer',
                'expiration'=>'required|date',
                'limitUses'=>'required|integer'
            ]);
    
            $newOffer= new Offer();
            $newOffer->type=$request->type;
            $newOffer->discount=$request->discount;
            $newOffer->expiration=$request->expiration;
            $newOffer->limitUses=$request->limitUses;
            $newOffer->save();

            $appliedProducts = explode(',', $request->applied);
            if($newOffer->type == "products"){
                $newOffer->product()->sync($appliedProducts);
            }else if($newOffer->type == "categories"){
                $newOffer->category()->sync($appliedProducts);
            }
            

            // Dentro del try del método create, después de $newProduct->save();

            DB::commit();
            return back() -> with('mensaje', 'Oferta creada');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo crear el la oferta');
        }
        
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $request->validate([
                'type2'=>'required',
                'applied'=>'required',
                'discount'=>'required|integer',
                'expiration'=>'required|date',
                'limitUses'=>'required|integer'
            ]);
    
            $updateOffer=Offer::findOrFail($id);
            $originalType= $updateOffer->type;
            $updateOffer->type=$request->type2;
            $updateOffer->discount=$request->discount;
            $updateOffer->expiration=$request->expiration;
            $updateOffer->limitUses=$request->limitUses;
            $updateOffer->save();
            
            //Eliminar relacion de oferta si se cambia de tipo
            if ($request->type2 != $originalType) {
                if ($originalType == "products") {
                    $updateOffer->product()->detach();
                } elseif ($originalType == "categories") {
                    $updateOffer->category()->detach();
                }
            }

            $appliedProducts = explode(',', $request->applied);
            if($updateOffer->type == "products"){
                $updateOffer->product()->sync($appliedProducts);
            }else if($updateOffer->type == "categories"){
                $updateOffer->category()->sync($appliedProducts);
            }
            

            // Dentro del try del método create, después de $newProduct->save();

            DB::commit();
            return back() -> with('mensaje', 'Oferta creada');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo crear el la oferta');
        }
    }
}
