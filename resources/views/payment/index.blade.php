@extends('layouts.plantilla')

@section('title', "Métodos de Pago")

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Mis Métodos de Pago</h2>

    <div class="row">
        @forelse($paymentMethods as $paymentMethod)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $paymentMethod->card_holder_name }}</h5>
                        <p class="card-text">
                            **** **** **** {{ substr($paymentMethod->card_number, -4) }} <br>
                            Expira el {{$paymentMethod->expiry_date}} <br>
                        </p>                        
                        <!-- Botón para borrar el método de pago -->
                        <form action="{{ route('payment.methods.destroy', $paymentMethod->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este método de pago?')">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No tienes métodos de pago guardados.</p>
        @endforelse
    </div>
    <a href="{{ route('payment.methods.create') }}" class="btn btn-primary mt-4">Añadir Nuevo Método de Pago</a>
</div>
@endsection
