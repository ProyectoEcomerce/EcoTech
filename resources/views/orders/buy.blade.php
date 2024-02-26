@extends('layouts.plantilla')

@section('title', 'Tu cesta')

@section('content')

    <div class="container mt-4">
        @if ($addresses->isNotEmpty())
            <div class="card mb-3 col-8">
                <div class="card-header">Dirección de Envío</div>
                <div class="card-body">
                    <p>{{ $addresses->first()->address }}, {{ $addresses->first()->city }},
                        {{ $addresses->first()->zip_code }}, {{ $addresses->first()->country }}</p>
                    <!-- Botón para cambiar dirección -->
                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#addressAccordion" aria-expanded="false" aria-controls="addressAccordion">
                        Cambiar dirección
                    </button>
                </div>
            </div>
            {{-- Acordeón con todas las direcciones excepto la primera --}}
            <div class="container mt-4">
                <div class="collapse col-8" id="addressAccordion">
                    @foreach ($addresses->skip(1) as $address)
                        {{-- Omite la primera dirección --}}
                        <div class="card card-body mb-2">
                            {{-- ... --}}
                            <button class="btn btn-primary select-address" data-address-id="{{ $address->id }}">
                                Seleccionar esta dirección
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <a href="{{ route('addresses.adresses') }}" class="btn btn-secondary">
                Añadir dirección de envío
            </a>
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
    </script>


@endsection
