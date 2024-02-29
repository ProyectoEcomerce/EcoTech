<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function adminCoupon() {
        $coupons=Coupon::paginate(6);
        return view('layouts.adminCoupon', compact('coupons'));
    }

    public function create(Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'code'=>'required',
                'discount'=>'required|integer',
                'expiration'=>'required|date',
                'limitUses'=>'required|integer'
            ]);
    
            $newCoupon= new Coupon();
            $newCoupon->code=$request->code;
            $newCoupon->discount=$request->discount;
            $newCoupon->expiration=$request->expiration;
            $newCoupon->limitUses=$request->limitUses;
            $newCoupon->save();

            // Dentro del try del método create, después de $newProduct->save();

            DB::commit();
            return back() -> with('mensaje', 'Cupón creado');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo crear el cupón');
        }
        
    }
    
}
