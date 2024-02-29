<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethods::where('user_id', auth()->id())->get(); // Ajusta la consulta según tu lógica de aplicación

        return view('payment.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'card_number' => 'required|string|size:16',
            'expiry_date' => 'required|date_format:Y-m-d|after:today',
            'cvc' => 'required|string|size:3',
        ]);

        $paymentMethod = new PaymentMethods([
            'user_id' => Auth::id(),
            'card_holder_name' => $request->card_holder_name,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvc' => $request->cvc,
        ]);

        $paymentMethod->save();

        return redirect()->route('payment.methods')->with('success', 'Método de pago añadido correctamente.');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethods::where('id', $id)
            ->where('user_id', Auth::id()) // Asegura que solo el dueño puede borrarlo
            ->firstOrFail();

        $paymentMethod->delete();

        return back()->with('success', 'Método de pago eliminado correctamente.');
    }

    public function changePaymentMethod(Request $request)
    {
        $user = Auth::user();
        $methodId = $request->input('methodId');
        $paymentMethod = $user->paymentMethods()->find($methodId);

        if ($paymentMethod) {
            // Aquí lógica para establecer este método como el predeterminado
            // Esto dependerá de cómo estés manejando el método de pago predeterminado en tu base de datos

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function cambiarMetodoPago(Request $request, $id)
    {
        // Lógica para cambiar el método de pago
        // Similar al método cambiarDireccion, utiliza el $id para encontrar el método de pago y actualizarlo
        return response()->json(['success' => true, 'message' => 'Método de pago actualizado correctamente.']);
    }
}
