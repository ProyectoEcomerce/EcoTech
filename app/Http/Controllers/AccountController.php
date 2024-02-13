<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return view('account.edit')->with('success', 'Contraseña actualizada con éxito.');
    }

    public function changeLocal(Request $request){

        if(Auth::check()){
            $user=Auth::user();
            $language=$request->route('locale');
            $user->language=$language;
            $user->save();
        }else{
            $language = $request->route('locale');
            session()->put('locale', $language);
        }
        return redirect()->back()->with('success', 'Idioma cambiado.');
    }
}
