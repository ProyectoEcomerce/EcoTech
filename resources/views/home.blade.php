@extends('layouts.plantilla')

@section('title', 'perfil')

@section('content')
    <main>
        <div class="container mt-4 mb-4">
            <h2 class="text-center mb-4">{{__("Mi cuenta")}}</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Mis pedidos -->
                <div class="col">
                    <a href="{{ route('orders.index') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-box"></i> {{__("Mis pedidos")}}</h5>
                                <p class="card-text">{{__("Gestiona tus pedidos y descarga su factura o ticket")}}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Direcciones -->
                <div class="col">
                    <a href="{{ route('addresses.index') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> {{__("Direcciones")}}</h5>
                                <p class="card-text">{{__("Editar, eliminar o añadir direcciones")}}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Edición de cuenta -->
                <div class="col">
                    <a href="{{ route('account.edit') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-lock"></i> {{__("Editar mi cuenta")}}</h5>
                                <p class="card-text">{{__("Cambiar la contraseña")}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
