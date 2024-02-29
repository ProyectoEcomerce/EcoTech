@extends('layouts.plantilla')

@section('title', 'Detalles del Pedido')

@section('content')
    @php$totalPedido = 0;
            @endphp
    <div class="container mt-4">
        <h2 class="text-center">Pedido número: {{ $order->id }}</h2>

        @foreach ($order->products as $product)
            <div class="card m-5">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">Cantidad: {{ $product->pivot->amount }}</p>
                    <p class="card-text">Precio por unidad: {{ number_format($product->price, 2, ',', '.') }}€</p>
                    <p class="card-text">Precio total:
                        {{ number_format($product->price * $product->pivot->amount, 2, ',', '.') }}€</p>
                    <p class="card-text">Voltaje: {{ $product->voltage }}</p>
                    <p class="card-text">Garantía: {{ $product->guarantee }}</p>
                    <p class="card-text">Peso: {{ $product->weigth }}</p>
                    <p class="card-text">Batería: {{ $product->battery }}</p>
                    <p class="card-text">Motor: {{ $product->engine }}</p>
                </div>
            </div>
        @endforeach
        <div class="text-center">
            <h4>Total del Pedido: {{ number_format($order->total_price, 2, ',', '.') }}€</h4>
        </div>

        <div class="d-flex">
            <div class=" p-5">
                <form action="{{ route('orders.invoice', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary btn-sm mb-4">
                        <i class="fas fa-trash-alt"></i> Ver factura
                    </button>
                </form>
            </div>
            <div class="p-5">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm mb-4">Volver</a>
            </div>
            <div class=" justify-content-end p-5">
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-danger btn-sm mb-4"
                        onclick="return confirm('¿Estás seguro de que quieres cancelar este pedido?');">
                        <i class="fas fa-trash-alt"></i> Cancelar pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
