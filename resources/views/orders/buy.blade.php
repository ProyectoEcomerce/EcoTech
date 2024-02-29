@extends('layouts.plantilla')

@section('title', 'Tu cesta')

@section('content')

    <!-- Suponiendo que $addresses contiene la dirección principal en el primer índice -->
    <div class="container mt-4">
        @if ($addresses->isNotEmpty())
            <div class="row mb-3">
                <div class="col-md-8">
                    <h3 class="text-success">1. Dirección de envío</h3>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $user->first()->name ?? 'Nombre del destinatario' }}</p>
                            <p class="card-text">{{ $addresses->first()->address }}</p>
                            <p class="card-text">{{ $addresses->first()->city }}, {{ $addresses->first()->zip_code }}</p>
                            <p class="card-text">{{ $addresses->first()->country }}</p>
                            <button class="btn btn-link text-decoration-none" data-bs-toggle="collapse"
                                data-bs-target="#addressAccordion">
                                Cambiar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sticky">
                    <!-- Columna para el botón de comprar y aplicar cupones -->
                    <div class="card">
                        @if ($validCoupon)
                            <form method="POST" action="{{ route('cart.purchase') }}">
                                @csrf
                                <input type="number" name="discount" value="{{ $couponSearch->id }}" hidden>
                                <button class="btn btn-warning m-3" type="submit">Comprar ahora</button>
                            </form>
                            <!-- Detalles de descuento aplicado -->
                            <div class="row text-center">
                                <div class="col">
                                    <h5 class="text-danger">Importe total:</h5>
                                </div>
                                <div class="col d-block">
                                    <div class="row">
                                        <h5 class="text-danger old-price">{{ number_format($totalAmount, 2) }} €</h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-danger">
                                            {{ number_format($totalAmount - ($totalAmount * $couponSearch->discount) / 100, 2) }}
                                            €
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @else
                            <form method="POST" action="{{ route('cart.purchase') }}">
                                @csrf
                                <button class="btn btn-warning m-3" type="submit">Comprar ahora</button>
                            </form>
                            <h5 class="text-danger">Importe total: {{ number_format($totalAmount, 2) }} €</h5>
                        @endif
                    </div>
                    <!-- Div de los cupones movido aquí, debajo del botón de comprar -->
                    <div class="card mb-2 mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Introduce tu código de descuento</h5>
                            @if ($validCoupon)
                                <form action="{{ route('orders.buy') }}" method="POST">
                                    @csrf
                                    <div class="d-inline-grid">
                                        <input type="text" name="cancel" class="card-text mb-2" value="false" hidden>
                                        <button class="btn btn-secondary btn-block" type="submit">Cancelar cupón</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('orders.buy') }}" method="POST">
                                    @csrf
                                    <div class="d-inline-grid">
                                        <input type="text" name="code" class="card-text mb-2">
                                        <button class="btn btn-secondary btn-block" type="submit">Canjear</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Acordeón para el resto de direcciones -->
            <div class="collapse col-md-8 mb-3" id="addressAccordion">
                @foreach ($addresses->skip(1) as $address)
                    <div class="card card-body mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{ $user->name ?? 'Nombre del destinatario' }}</p>
                                <p>{{ $address->address }}</p>
                                <p>{{ $address->city }}, {{ $address->zip_code }}</p>
                                <p>{{ $address->country }}</p>
                            </div>
                            <button class="btn btn-primary select-address m-70" data-address-id="{{ $address->id }}">
                                Seleccionar esta dirección
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <h3 class="text-success">2. Método de pago</h3>
                    <div class="card">
                        <div class="card-body">
                            @if ($firstPaymentMethod)
                                <p class="card-text">Tarjeta de crédito</p>
                                <p class="card-text">Titular: {{ $firstPaymentMethod->card_holder_name }}</p>
                                <p class="card-text">Número de tarjeta: **** **** ****
                                    {{ substr($firstPaymentMethod->card_number, -4) }}</p>
                                <p class="card-text">Fecha de caducidad:
                                    {{ \Carbon\Carbon::parse($firstPaymentMethod->expiry_date)->format('m/Y') }}</p>
                                <button class="btn btn-link text-decoration-none" data-bs-toggle="collapse"
                                    data-bs-target="#paymentAccordion">Cambiar</button>
                            @else
                                <p>No hay un método de pago predeterminado. Por favor, añade uno.</p>
                            @endif
                        </div>
                    </div>
                    <!-- Acordeón con los demás métodos de pago -->
                    <div class="collapse" id="paymentAccordion">
                        @foreach ($paymentMethods as $method)
                            @if ($method->id !== $firstPaymentMethod->id)
                                <div class="card card-body mb-2">
                                    <p>Titular: {{ $method->card_holder_name }}</p>
                                    <p>Número de tarjeta: **** **** **** {{ substr($method->card_number, -4) }}</p>
                                    <p>Fecha de caducidad: {{ \Carbon\Carbon::parse($method->expiry_date)->format('m/Y') }}
                                    </p>
                                    <button class="btn btn-primary select-payment-method"
                                        data-method-id="{{ $method->id }}">Seleccionar este método de pago</button>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-8">
                    <h3 class="text-success">3. Revisar productos</h3>
                    @forelse ($products as $product)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p>Cantidad: {{ $product->pivot->amount }}</p>
                                <p>Precio unitario: {{ number_format($product->price, 2) }}€</p>
                                <p class="text-danger text-decoration-underline">Subtotal:
                                    {{ number_format($product->pivot->amount * $product->price, 2) }}€</p>
                            </div>
                        </div>
                    @empty
                        <p>No hay productos en el carrito.</p>
                    @endforelse
                </div>
            </div>
        @else
            <p>No tienes direcciones de envío. Por favor, añade una.</p>
            <a href="{{ route('addresses.create') }}" class="btn btn-primary">Añadir dirección</a>
        @endif

    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.select-address').on('click', function() {
                var addressId = $(this).data('address-id');
                $.ajax({
                    url: '/cambiar-direccion-envio', // URL del endpoint que maneja el cambio de dirección
                    type: 'POST',
                    data: {
                        'address_id': addressId,
                        '_token': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    success: function(response) {
                        // Actualizar la dirección de envío mostrada al usuario
                        alert('La dirección de envío ha sido actualizada.');
                        // Opcionalmente, recargar la página o actualizar parte de la página con la nueva dirección
                    },
                    error: function(error) {
                        // Manejar errores, por ejemplo, mostrar un mensaje
                        console.log(error);
                        alert('Hubo un error al cambiar la dirección de envío.');
                    }
                });
            });
        });

        document.querySelectorAll('.select-payment-method').forEach(function(button) {
            button.addEventListener('click', function() {
                var methodId = this.getAttribute('data-method-id');
                fetch('/ruta-para-cambiar-metodo-de-pago', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            methodId: methodId
                        })
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        if (data.success) {
                            window.location.reload();
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            });
        });
    </script>


@endsection
