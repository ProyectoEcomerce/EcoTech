<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function adminOffer() {
        $offers=Offer::paginate(6);
        return view('layouts.adminOffer', compact('offers'));
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
            $newOffer->applied=$request->applied;
            $newOffer->discount=$request->discount;
            $newOffer->expiration=$request->expiration;
            $newOffer->limitUses=$request->limitUses;
            $newOffer->save();

            // Dentro del try del método create, después de $newProduct->save();

            DB::commit();
            return back() -> with('mensaje', 'Oferta creada');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo crear el la oferta');
        }
        
    }
}