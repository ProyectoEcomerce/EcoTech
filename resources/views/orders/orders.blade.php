@extends('layouts.plantilla')

@section('title', "Pedidos")

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Mis Pedidos</h2>
    <!-- Barra de búsqueda (puedes dejarla estática o implementar su funcionalidad) -->
    <div class="search-bar row mb-4">
        <div class="col">
            <input type="text" class="form-control search-input" placeholder="Año">
        </div>
        <div class="col">
            <input type="text" class="form-control search-input" placeholder="Mes">
        </div>
        <div class="col">
            <input type="text" class="form-control search-input" placeholder="Busqueda">
        </div>
    </div>

    <!-- Iterar sobre los pedidos del usuario -->
    @forelse(auth()->user()->orders as $order)
        <a href="{{ route('orders.cancel', $order->id) }}" class="text-decoration-none text-dark">
            <div class="order-status mb-3 p-3 shadow-sm">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Pedido #{{ $order->id }}</strong>
                    </div>
                    <div class="col-md-3">
                        Estado: {{ $order->status }}
                    </div>
                    <div class="col-md-3">
                        Fecha pedido: {{ $order->created_at->format('d/m/Y') }}
                    </div>
                    <div class="col-md-3">
                        Fecha entrega: {{ $order->delivery_date ? $order->delivery_date->format('d/m/Y') : 'Por confirmar' }}
                    </div>
                </div>
            </div>
        </a>
    @empty
        <p>No tienes pedidos.</p>
    @endforelse
</div>
@endsection


