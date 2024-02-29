<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;

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




}
