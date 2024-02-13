<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('adresses.address', compact('addresses'));
    }


    public function create()
    {
        return view('adresses.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            // Validación de los campos del formulario
            $request->validate([
                'address' => 'required|string|max:45',
                'city' => 'required|string|max:45',
                'zip_code' => 'required|string|max:10', // Ajusta el tamaño máximo según sea necesario
                'country' => 'required|string|max:45',
            ]);
    
            // Creación de la nueva dirección
            $address = new Address([
                'address' => $request->address,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
            ]);
    
            // Asociar la nueva dirección al usuario autenticado y guardarla
            Auth::user()->addresses()->save($address);

            DB::commit();
            // Redireccionar al usuario a la lista de direcciones con un mensaje de éxito
            return redirect()->route('addresses.adresses')->with('success', 'Dirección añadida con éxito.');
        }catch (\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se ha podido crear su dirección');
        }
    }

    public function edit(Address $address)
    {
        if (Auth::id() !== $address->user_id) {
            abort(403);
        }

        return view('adresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'address' => 'required|string|max:45',
                'city' => 'required|string|max:45',
                'zip_code' => 'required|string|max:10',
                'country' => 'required|string|max:45',
            ]);
    
            $address->update($request->all());
            DB::commit();
            return redirect()->route('addresses.adresses')->with('success', 'Dirección actualizada con éxito.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo cambiar la dirección');
        }
    }

    public function destroy(Address $address)
    {
        DB::beginTransaction();
        try{
            $address->delete();
            DB::commit();
            return back()->with('success', 'Dirección eliminada con éxito.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo eliminar la dirección');
        }
    }
}
