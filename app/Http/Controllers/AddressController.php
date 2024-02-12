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
        return view('address.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validaciones para tu dirección
        ]);

        $address = new Address($request->all());
        Auth::user()->addresses()->save($address);

        return redirect()->route('addresses.index')->with('success', 'Dirección añadida con éxito.');
    }

    public function edit(Address $address)
    {
        return view('address.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            // Validaciones para tu dirección
        ]);

        $address->update($request->all());
        return redirect()->route('addresses.index')->with('success', 'Dirección actualizada con éxito.');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return back()->with('success', 'Dirección eliminada con éxito.');
    }
}
