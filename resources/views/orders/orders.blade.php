@extends('layouts.plantilla')

@section('title', 'Mis Pedidos')

@section('content')
<main>
    <div class="container mt-4 mb-4">
        <h2>Mis Pedidos</h2>
        @if($orders->isEmpty())
            <p>No tienes pedidos aún.</p>
        @else
            <div class="list-group">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="list-group-item list-group-item-action">
                        Pedido #{{ $order->id }} - Fecha: {{ $order->created_at->toFormattedDateString() }} - Total: {{ $order->total }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</main>
@endsection


