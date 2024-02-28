@extends('layouts.plantilla')

@section('title', "Métodos de Pago")

@section('content')
<div class="container">
    <h2>Agregar Método de Pago</h2>
    <form action="{{ route('payment.methods.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="card_holder_name" class="form-label">Nombre del Titular</label>
            <input type="text" class="form-control" id="card_holder_name" name="card_holder_name" required>
        </div>
        <div class="mb-3">
            <label for="card_number" class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Fecha de Expiración</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
        </div>
        <div class="mb-3">
            <label for="cvc" class="form-label">CVC</label>
            <input type="text" class="form-control" id="cvc" name="cvc" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
@endsection