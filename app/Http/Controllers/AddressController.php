<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

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

        // Redireccionar al usuario a la lista de direcciones con un mensaje de éxito
        return redirect()->route('addresses.adresses')->with('success', 'Dirección añadida con éxito.');
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
        $request->validate([
            'address' => 'required|string|max:45',
            'city' => 'required|string|max:45',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:45',
        ]);

        $address->update($request->all());
        return redirect()->route('addresses.adresses')->with('success', 'Dirección actualizada con éxito.');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return back()->with('success', 'Dirección eliminada con éxito.');
    }
}
